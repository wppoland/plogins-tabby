<?php
/**
 * Default settings, stored under the `tabby_settings` option.
 *
 * `global_tabs` is the list of reusable tabs the merchant defines on the Tabby
 * settings screen; each renders on every single product page (unless hidden by
 * a per-product override). `ordering` controls where Tabby's custom tabs sit
 * relative to the native WooCommerce tabs.
 *
 * @package Tabby
 *
 * @return array<string, mixed>
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

return [
    'enabled' => true,

    // Where Tabby's custom tabs sit relative to WooCommerce's native tabs:
    // 'after' (Description, Additional information, Reviews, then custom) or
    // 'before' (custom tabs first).
    'ordering' => 'after',

    /*
     * Reusable global tabs. Each entry:
     *   id      => stable slug (a-z0-9_-), used as the tab key.
     *   title   => tab label (plain text).
     *   content => tab body (limited safe HTML, wp_kses_post).
     *   enabled => bool master toggle for this tab.
     *
     * @var array<int, array<string, mixed>>
     */
    'global_tabs' => [],
];
