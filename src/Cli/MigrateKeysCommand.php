<?php

namespace JorenRothman\ACFBuilder\Cli;

use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\KeyStrategy;
use JorenRothman\ACFBuilder\Migration\KeyMigration;

/**
 * WP-CLI command: wp acf-builder migrate-keys
 *
 * @package JorenRothman\ACFBuilder\Cli
 */
class MigrateKeysCommand
{
    private static bool $registered = false;

    public static function register(): void
    {
        if (self::$registered || !class_exists('WP_CLI')) {
            return;
        }

        self::$registered = true;

        \WP_CLI::add_command('acf-builder migrate-keys', new self());
    }

    /**
     * Rewrite stored field key references from legacy keys to path keys.
     *
     * Only field groups using the path key strategy are migrated. Back up the database first.
     *
     * ## OPTIONS
     *
     * [--dry-run]
     * : Count matching rows without changing anything.
     *
     * @param array $args
     * @param array $assocArgs
     * @return void
     */
    public function __invoke(array $args, array $assocArgs): void
    {
        global $wpdb;

        $dryRun = (bool) ($assocArgs['dry-run'] ?? false);

        $map = [];
        foreach (FieldGroup::getRegistered() as $fieldGroup) {
            if ($fieldGroup->getKeyStrategy() === KeyStrategy::PATH) {
                $map += $fieldGroup->migrationMap();
            }
        }

        if (!$map) {
            \WP_CLI::warning('No field groups use the path key strategy, nothing to migrate.');

            return;
        }

        try {
            $affected = (new KeyMigration($wpdb))->run($map, $dryRun);
        } catch (\LogicException $e) {
            \WP_CLI::error($e->getMessage());
        }

        if ($dryRun) {
            \WP_CLI::success(sprintf('%d keys, %d rows would be updated.', count($map), $affected));

            return;
        }

        wp_cache_flush();

        \WP_CLI::success(sprintf('%d keys, %d rows updated.', count($map), $affected));
    }
}
