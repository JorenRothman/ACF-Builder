<?php

namespace JorenRothman\ACFBuilder\Cli;

use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\KeyStrategy;
use JorenRothman\ACFBuilder\Migration\KeyMigration;
use JorenRothman\ACFBuilder\Migration\KeyResolver;

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
     * Rewrite stored field key references to path keys.
     *
     * Each reference is resolved from the name its value is stored under, so references
     * written by any earlier key scheme are migrated. Only field groups using the path
     * key strategy are migrated. Back up the database first.
     *
     * ## OPTIONS
     *
     * [--dry-run]
     * : Count the rows that would change without changing anything.
     *
     * @param array $args
     * @param array $assocArgs
     * @return void
     */
    public function __invoke(array $args, array $assocArgs): void
    {
        global $wpdb;

        $dryRun = (bool) ($assocArgs['dry-run'] ?? false);

        $fields = [];
        $candidates = [];
        foreach (FieldGroup::getRegistered() as $fieldGroup) {
            if ($fieldGroup->getKeyStrategy() !== KeyStrategy::PATH) {
                continue;
            }

            array_push($fields, ...$fieldGroup->build()['fields']);

            foreach ($fieldGroup->migrationMap() as $oldKey => $newKey) {
                $candidates[$oldKey][$newKey] = true;
            }
        }

        if (!$fields) {
            \WP_CLI::warning('No field groups use the path key strategy, nothing to migrate.');

            return;
        }

        // Legacy layout keys are shared between field groups, so only a key with a single new key can be mapped blindly.
        $map = array_map(
            fn(array $newKeys) => array_key_first($newKeys),
            array_filter($candidates, fn(array $newKeys) => count($newKeys) === 1)
        );

        $migration = new KeyMigration($wpdb);

        try {
            $affected = $migration->run(new KeyResolver($fields), $map, $dryRun);
        } catch (\LogicException $e) {
            \WP_CLI::error($e->getMessage());
        }

        $skipped = $migration->getSkipped();

        if ($dryRun) {
            \WP_CLI::success(sprintf('%d rows would be updated, %d unresolved rows would be skipped.', $affected, $skipped));

            return;
        }

        wp_cache_flush();

        \WP_CLI::success(sprintf('%d rows updated, %d unresolved rows skipped.', $affected, $skipped));
    }
}
