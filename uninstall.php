<?php
/**
 * Tabby uninstall routine. Removes the plugin's stored settings and version
 * marker.
 *
 * @package Tabby
 */

declare(strict_types=1);

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('tabby_settings');
delete_option('tabby_db_version');

// The PRO banner's dismissal is stored per user, so it belongs to the
// plugin rather than to the site content. User meta is global, not
// per-site, which is why this uses delete_metadata's \$delete_all rather
// than a loop over the users of one blog.
delete_metadata('user', 0, 'tabby_pro_banner_dismissed', '', true);
