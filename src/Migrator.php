<?php

declare(strict_types=1);

namespace Tabby;

defined('ABSPATH') || exit;

/**
 * Idempotent migrations, run on every boot. Tabby stores everything in options
 * and post meta (no custom tables), so the only job here is to seed sane
 * defaults the first time the plugin runs and track the schema version for any
 * future forward steps.
 */
final class Migrator
{
    private const OPTION = 'tabby_db_version';

    public function maybeMigrate(): void
    {
        $current = (string) get_option(self::OPTION, '0');

        if (version_compare($current, VERSION, '>=')) {
            return;
        }

        // Seed packaged settings defaults once, without overwriting an existing
        // configuration.
        if (false === get_option('tabby_settings', false)) {
            /** @var array<string, mixed> $defaults */
            $defaults = require TABBY_DIR . 'config/defaults.php';
            add_option('tabby_settings', $defaults, '', false);
        }

        update_option(self::OPTION, VERSION, false);
    }
}
