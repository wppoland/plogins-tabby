<?php
/**
 * Tabby uninstall routine. Removes the plugin's stored settings and version
 * marker. Per-product tab meta is intentionally left in place so reinstalling
 * does not silently destroy product content the merchant may want back.
 *
 * @package Tabby
 */

declare(strict_types=1);

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('tabby_settings');
delete_option('tabby_db_version');
