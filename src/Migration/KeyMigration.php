<?php

namespace JorenRothman\ACFBuilder\Migration;

/**
 * Rewrites stored ACF field key references, e.g. after switching a field group to KeyStrategy::PATH.
 *
 * ACF stores each value under the field name and a reference to the field key under "_" . name.
 * Values are untouched, only those references are rewritten.
 *
 * @package JorenRothman\ACFBuilder\Migration
 */
class KeyMigration
{
    /**
     * @param \wpdb|object $wpdb
     */
    public function __construct(private object $wpdb)
    {
    }

    /**
     * Rewrite every reference to an old key into its new key.
     *
     * @param array<string, string> $map Old key => new key.
     * @param bool $dryRun Only count matching rows.
     * @return int Number of rows changed, or matched when $dryRun is true.
     * @throws \LogicException When a new key is also an old key, as the result would depend on order.
     */
    public function run(array $map, bool $dryRun = false): int
    {
        $chained = array_intersect(array_values($map), array_keys($map));

        if ($chained) {
            throw new \LogicException('Key map is chained, new keys are also old keys: ' . implode(', ', $chained));
        }

        $affected = 0;

        foreach ($map as $oldKey => $newKey) {
            foreach ($this->queries($oldKey, $newKey, $dryRun) as $query) {
                $affected += (int) $this->wpdb->query($query);
            }
        }

        return $affected;
    }

    /**
     * @param string $oldKey
     * @param string $newKey
     * @param bool $dryRun
     * @return string[]
     */
    private function queries(string $oldKey, string $newKey, bool $dryRun): array
    {
        $wpdb = $this->wpdb;
        $reference = $wpdb->esc_like('_') . '%';
        $queries = [];

        $stores = [
            [$wpdb->postmeta, 'meta_key', 'meta_value'],
            [$wpdb->termmeta, 'meta_key', 'meta_value'],
            [$wpdb->usermeta, 'meta_key', 'meta_value'],
            [$wpdb->commentmeta, 'meta_key', 'meta_value'],
            [$wpdb->options, 'option_name', 'option_value'],
        ];

        foreach ($stores as [$table, $nameColumn, $valueColumn]) {
            $queries[] = $dryRun
                ? $wpdb->prepare("SELECT 1 FROM {$table} WHERE {$valueColumn} = %s AND {$nameColumn} LIKE %s", $oldKey, $reference)
                : $wpdb->prepare("UPDATE {$table} SET {$valueColumn} = %s WHERE {$valueColumn} = %s AND {$nameColumn} LIKE %s", $newKey, $oldKey, $reference);
        }

        // ACF blocks store references in the block comment JSON, e.g. "_title":"field_hero_title".
        $quotedOld = '"' . $oldKey . '"';
        $quotedNew = '"' . $newKey . '"';
        $contains = '%' . $wpdb->esc_like($quotedOld) . '%';

        $queries[] = $dryRun
            ? $wpdb->prepare("SELECT 1 FROM {$wpdb->posts} WHERE post_content LIKE %s", $contains)
            : $wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s) WHERE post_content LIKE %s", $quotedOld, $quotedNew, $contains);

        return $queries;
    }
}
