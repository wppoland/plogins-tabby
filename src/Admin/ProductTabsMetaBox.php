<?php

declare(strict_types=1);

namespace Tabby\Admin;

use Tabby\Contract\HasHooks;
use Tabby\Domain\TabRepository;

defined('ABSPATH') || exit;

/**
 * Per-product tabs metabox on the product editor.
 *
 * Lets a merchant add tabs that exist only on one product, and tick which
 * global tabs to hide for that product. Saved to post meta via
 * {@see TabRepository}. All output escaped; all input sanitised; nonce-guarded.
 */
final class ProductTabsMetaBox implements HasHooks
{
    private const NONCE_ACTION = 'tabby_save_product_tabs';
    private const NONCE_NAME   = 'tabby_product_tabs_nonce';

    public function __construct(private readonly TabRepository $tabs)
    {
    }

    public function registerHooks(): void
    {
        add_action('add_meta_boxes', [$this, 'addMetaBox']);
        add_action('save_post_product', [$this, 'save'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    public function enqueueAssets(string $hookSuffix): void
    {
        if ('post.php' !== $hookSuffix && 'post-new.php' !== $hookSuffix) {
            return;
        }

        $screen = function_exists('get_current_screen') ? get_current_screen() : null;
        if (null === $screen || 'product' !== $screen->post_type) {
            return;
        }

        wp_enqueue_style(
            'tabby-admin',
            \Tabby\Plugin::instance()->url('assets/css/admin.css'),
            [],
            \Tabby\VERSION,
        );

        wp_enqueue_script(
            'tabby-metabox',
            \Tabby\Plugin::instance()->url('assets/js/metabox.js'),
            [],
            \Tabby\VERSION,
            ['in_footer' => true, 'strategy' => 'defer'],
        );
    }

    public function addMetaBox(): void
    {
        add_meta_box(
            'tabby-product-tabs',
            __('Custom Product Tabs (Tabby)', 'tabby'),
            [$this, 'render'],
            'product',
            'normal',
            'default',
        );
    }

    public function render(\WP_Post $post): void
    {
        if (! current_user_can('manage_woocommerce')) {
            return;
        }

        wp_nonce_field(self::NONCE_ACTION, self::NONCE_NAME);

        $productTabs = $this->tabs->productTabs($post->ID);
        $hidden      = $this->tabs->hiddenGlobalTabIds($post->ID);
        $globalTabs  = $this->tabs->globalTabs();
        ?>
        <div class="tabby-metabox">
            <p class="tabby-metabox__intro">
                <?php esc_html_e('Add tabs that appear only on this product, and choose which shared global tabs to hide here. Global tabs are managed under WooCommerce → Tabby.', 'tabby'); ?>
            </p>

            <?php if ([] !== $globalTabs) : ?>
                <fieldset class="tabby-metabox__section">
                    <legend><?php esc_html_e('Hide global tabs on this product', 'tabby'); ?></legend>
                    <?php foreach ($globalTabs as $tab) : ?>
                        <label class="tabby-metabox__checkbox">
                            <input
                                type="checkbox"
                                name="tabby_hidden_globals[]"
                                value="<?php echo esc_attr($tab->id); ?>"
                                <?php checked(in_array($tab->id, $hidden, true), true); ?>
                            />
                            <?php echo esc_html($tab->title); ?>
                            <?php if (! $tab->enabled) : ?>
                                <span class="tabby-metabox__muted">(<?php esc_html_e('disabled globally', 'tabby'); ?>)</span>
                            <?php endif; ?>
                        </label>
                    <?php endforeach; ?>
                </fieldset>
            <?php endif; ?>

            <fieldset class="tabby-metabox__section">
                <legend><?php esc_html_e('Tabs for this product only', 'tabby'); ?></legend>

                <div class="tabby-repeater" data-tabby-repeater>
                    <div class="tabby-repeater__rows" data-tabby-rows>
                        <?php
                        if ([] === $productTabs) {
                            $this->renderRow(0, '', '', true);
                        } else {
                            foreach (array_values($productTabs) as $index => $tab) {
                                $this->renderRow((int) $index, $tab->title, $tab->content, $tab->enabled);
                            }
                        }
                        ?>
                    </div>

                    <template data-tabby-template>
                        <?php $this->renderRow(0, '', '', true, true); ?>
                    </template>

                    <p>
                        <button type="button" class="button button-secondary" data-tabby-add>
                            <?php esc_html_e('Add tab', 'tabby'); ?>
                        </button>
                    </p>
                </div>
            </fieldset>
        </div>
        <?php
    }

    /**
     * Render a single repeater row. When $isTemplate is true the index token is
     * left as `__index__` for the JS to substitute on clone.
     */
    private function renderRow(int $index, string $title, string $content, bool $enabled, bool $isTemplate = false): void
    {
        $i = $isTemplate ? '__index__' : (string) $index;
        ?>
        <div class="tabby-repeater__row" data-tabby-row>
            <div class="tabby-repeater__head">
                <label class="tabby-repeater__field tabby-repeater__field--title">
                    <span class="tabby-repeater__label"><?php esc_html_e('Tab title', 'tabby'); ?></span>
                    <input
                        type="text"
                        name="tabby_product_tabs[<?php echo esc_attr($i); ?>][title]"
                        value="<?php echo esc_attr($title); ?>"
                        class="widefat"
                        placeholder="<?php esc_attr_e('e.g. Shipping & Returns', 'tabby'); ?>"
                    />
                </label>
                <label class="tabby-repeater__toggle">
                    <input
                        type="checkbox"
                        name="tabby_product_tabs[<?php echo esc_attr($i); ?>][enabled]"
                        value="1"
                        <?php checked($enabled, true); ?>
                    />
                    <?php esc_html_e('Enabled', 'tabby'); ?>
                </label>
                <button type="button" class="button-link tabby-repeater__remove" data-tabby-remove>
                    <span aria-hidden="true">&times;</span>
                    <span class="screen-reader-text"><?php esc_html_e('Remove this tab', 'tabby'); ?></span>
                </button>
            </div>
            <label class="tabby-repeater__field">
                <span class="tabby-repeater__label"><?php esc_html_e('Tab content', 'tabby'); ?></span>
                <textarea
                    name="tabby_product_tabs[<?php echo esc_attr($i); ?>][content]"
                    rows="4"
                    class="widefat"
                    placeholder="<?php esc_attr_e('Basic HTML is allowed (links, lists, bold, etc.).', 'tabby'); ?>"
                ><?php echo esc_textarea($content); ?></textarea>
            </label>
        </div>
        <?php
    }

    /**
     * @param int|string $postId
     */
    public function save($postId, \WP_Post $post): void
    {
        $postId = (int) $postId;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (! isset($_POST[self::NONCE_NAME])) {
            return;
        }

        $nonce = sanitize_text_field(wp_unslash((string) $_POST[self::NONCE_NAME]));
        if (! wp_verify_nonce($nonce, self::NONCE_ACTION)) {
            return;
        }

        if (! current_user_can('manage_woocommerce')) {
            return;
        }

        if ('product' !== $post->post_type) {
            return;
        }

        // Per-product tabs.
        $rows = [];
        if (isset($_POST['tabby_product_tabs']) && is_array($_POST['tabby_product_tabs'])) {
            // Nonce verified above; deep-sanitised field-by-field below.
            $raw = wp_unslash($_POST['tabby_product_tabs']); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            foreach ((array) $raw as $entry) {
                if (! is_array($entry)) {
                    continue;
                }
                $title = isset($entry['title']) ? sanitize_text_field((string) $entry['title']) : '';
                if ('' === $title) {
                    continue;
                }
                $rows[] = [
                    'id'      => $this->slugify($title, count($rows)),
                    'title'   => $title,
                    'content' => isset($entry['content']) ? wp_kses_post((string) $entry['content']) : '',
                    'enabled' => ! empty($entry['enabled']),
                ];
            }
        }
        $this->tabs->saveProductTabs($postId, $rows);

        // Hidden global tabs.
        $hidden = [];
        if (isset($_POST['tabby_hidden_globals']) && is_array($_POST['tabby_hidden_globals'])) {
            // Nonce verified above; each value sanitised via sanitize_key.
            $rawHidden = wp_unslash($_POST['tabby_hidden_globals']); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
            foreach ((array) $rawHidden as $id) {
                $hidden[] = sanitize_key((string) $id);
            }
        }
        $this->tabs->saveHiddenGlobalTabIds($postId, $hidden);
    }

    /**
     * Build a stable, unique-ish slug for a per-product tab from its title.
     */
    private function slugify(string $title, int $position): string
    {
        $slug = sanitize_key($title);
        if ('' === $slug) {
            $slug = 'tab';
        }

        return 'p_' . $slug . '_' . $position;
    }
}
