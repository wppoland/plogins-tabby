<?php

declare(strict_types=1);

namespace Tabby\Domain;

defined('ABSPATH') || exit;

/**
 * Single source of truth for tab data.
 *
 * Global tabs live in the `tabby_settings` option; per-product tabs and the
 * "hidden global tab" overrides live in product post meta. Everything is read
 * back through {@see Tab} value objects, so callers never touch raw arrays and
 * all content is consistently sanitised.
 */
final class TabRepository
{
    public const OPTION              = 'tabby_settings';
    public const META_PRODUCT_TABS   = '_tabby_product_tabs';
    public const META_HIDDEN_GLOBALS = '_tabby_hidden_globals';

    /**
     * Whether Tabby is globally enabled.
     */
    public function isEnabled(): bool
    {
        return ! empty($this->settings()['enabled']);
    }

    /**
     * Ordering preference: 'after' or 'before' the native WooCommerce tabs.
     */
    public function ordering(): string
    {
        $ordering = (string) ($this->settings()['ordering'] ?? 'after');

        return in_array($ordering, ['after', 'before'], true) ? $ordering : 'after';
    }

    /**
     * All configured global tabs (enabled and disabled), in stored order.
     *
     * @return array<int, Tab>
     */
    public function globalTabs(): array
    {
        $rows = $this->settings()['global_tabs'] ?? [];
        if (! is_array($rows)) {
            return [];
        }

        $tabs = [];
        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }
            $tab = Tab::fromArray($row, Tab::SOURCE_GLOBAL);
            if (null !== $tab) {
                $tabs[] = $tab;
            }
        }

        return $tabs;
    }

    /**
     * Per-product tabs stored on a single product.
     *
     * @return array<int, Tab>
     */
    public function productTabs(int $productId): array
    {
        if ($productId <= 0) {
            return [];
        }

        $rows = get_post_meta($productId, self::META_PRODUCT_TABS, true);
        if (! is_array($rows)) {
            return [];
        }

        $tabs = [];
        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }
            $tab = Tab::fromArray($row, Tab::SOURCE_PRODUCT);
            if (null !== $tab) {
                $tabs[] = $tab;
            }
        }

        return $tabs;
    }

    /**
     * Global tab ids hidden on a single product.
     *
     * @return array<int, string>
     */
    public function hiddenGlobalTabIds(int $productId): array
    {
        if ($productId <= 0) {
            return [];
        }

        $ids = get_post_meta($productId, self::META_HIDDEN_GLOBALS, true);
        if (! is_array($ids)) {
            return [];
        }

        return array_values(array_filter(array_map(
            static fn ($id): string => sanitize_key((string) $id),
            $ids,
        )));
    }

    /**
     * Resolve the full, ordered list of enabled tabs to render for a product:
     * the enabled global tabs (minus any hidden on this product) followed by the
     * product's own tabs. Returns Tab objects keyed by their unique render key.
     *
     * @return array<int, Tab>
     */
    public function resolveForProduct(int $productId): array
    {
        if (! $this->isEnabled()) {
            return [];
        }

        $hidden  = $this->hiddenGlobalTabIds($productId);
        $resolved = [];

        foreach ($this->globalTabs() as $tab) {
            if (! $tab->enabled) {
                continue;
            }
            if (in_array($tab->id, $hidden, true)) {
                continue;
            }
            $resolved[] = $tab;
        }

        foreach ($this->productTabs($productId) as $tab) {
            if ($tab->enabled) {
                $resolved[] = $tab;
            }
        }

        return $resolved;
    }

    /**
     * Persist the per-product tabs for a product (already-sanitised rows).
     *
     * @param array<int, array<string, mixed>> $rows
     */
    public function saveProductTabs(int $productId, array $rows): void
    {
        if ($productId <= 0) {
            return;
        }

        if ([] === $rows) {
            delete_post_meta($productId, self::META_PRODUCT_TABS);
            return;
        }

        update_post_meta($productId, self::META_PRODUCT_TABS, $rows);
    }

    /**
     * Persist the hidden-global-tab ids for a product.
     *
     * @param array<int, string> $ids
     */
    public function saveHiddenGlobalTabIds(int $productId, array $ids): void
    {
        if ($productId <= 0) {
            return;
        }

        $ids = array_values(array_filter(array_map(
            static fn ($id): string => sanitize_key((string) $id),
            $ids,
        )));

        if ([] === $ids) {
            delete_post_meta($productId, self::META_HIDDEN_GLOBALS);
            return;
        }

        update_post_meta($productId, self::META_HIDDEN_GLOBALS, $ids);
    }

    /**
     * Stored settings merged over packaged defaults.
     *
     * @return array<string, mixed>
     */
    public function settings(): array
    {
        $stored = get_option(self::OPTION, []);
        if (! is_array($stored)) {
            $stored = [];
        }

        /** @var array<string, mixed> $defaults */
        $defaults = require TABBY_DIR . 'config/defaults.php';

        return array_merge($defaults, $stored);
    }
}
