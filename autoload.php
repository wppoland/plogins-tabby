<?php
/**
 * Autoloading: prefer Composer's optimized classmap when present. Fall back to a
 * minimal PSR-4 autoloader so the plugin still boots if vendor/ is somehow
 * absent. Tabby is self-contained — it has no runtime Composer dependencies.
 *
 * @package Tabby
 */

declare(strict_types=1);

namespace Tabby;

defined('ABSPATH') || exit;

$tabby_composer = __DIR__ . '/vendor/autoload.php';
if (is_readable($tabby_composer)) {
    require_once $tabby_composer;
    return;
}

spl_autoload_register(static function (string $class): void {
    $prefix  = 'Tabby\\';
    $baseDir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative = substr($class, $len);
    $file     = $baseDir . str_replace('\\', '/', $relative) . '.php';
    if (is_readable($file)) {
        require_once $file;
    }
});
