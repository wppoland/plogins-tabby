<?php
/**
 * Constants needed by PHPStan to analyse the plugin without bootstrapping
 * WordPress.
 *
 * @package Tabby
 */

declare(strict_types=1);

namespace {
    if (! defined('ABSPATH')) {
        define('ABSPATH', '/tmp/wordpress/');
    }
    if (! defined('TABBY_DIR')) {
        define('TABBY_DIR', '/tmp/tabby/');
    }
    if (! defined('TABBY_URL')) {
        define('TABBY_URL', 'https://example.test/wp-content/plugins/tabby/');
    }
}

namespace Tabby {
    if (! defined('Tabby\\VERSION')) {
        define('Tabby\\VERSION', '0.1.0');
    }
    if (! defined('Tabby\\PLUGIN_FILE')) {
        define('Tabby\\PLUGIN_FILE', '/tmp/tabby/tabby.php');
    }
}
