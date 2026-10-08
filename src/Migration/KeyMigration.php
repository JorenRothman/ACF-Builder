<?php

namespace JorenRothman\ACFBuilder\Migration;

/**
 * Rewrites stored field key references to the keys of the current field definitions.
 *
 * Every reference is resolved from the name its value is stored under, see KeyResolver.
 * References whose name does not resolve fall back to the old to new key map, as long
 * as the old key maps to a single new key. Values themselves are never touched.
 *
 * @package JorenRothman\ACFBuilder\Migration
 */
class KeyMigration
{
    private int $skipped = 0;

    /** @var array<string, mixed> */
    private array $valueCache = [];

    public function __construct(private object $wpdb)
    {
    }

    /**
     * @param KeyResolver $resolver
     * @param array<string, string> $map Old key to new key, only keys that map to a single new key.
     * @param bool $dryRun Count the references that would change without changing them.
     * @return int Number of references updated, or that would be updated.
     */
    public function run(KeyResolver $resolver, array $map, bool $dryRun = false): int
    {
        $chained = array_intersect(array_values($map), array_keys($map));

        if ($chained) {
            throw new \LogicException('Key map is chained, new keys are also old keys: ' . implode(', ', $chained));
        }

        $this->skipped = 0;
        $this->valueCache = [];

        $wpdb = $this->wpdb;
        $affected = 0;

        $metaStores = [
            [$wpdb->postmeta, 'meta_id', 'post_id'],
            [$wpdb->termmeta, 'meta_id', 'term_id'],
            [$wpdb->usermeta, 'umeta_id', 'user_id'],
            [$wpdb->commentmeta, 'meta_id', 'comment_id'],
        ];

        foreach ($metaStores as [$table, $idColumn, $objectColumn]) {
            $affected += $this->migrateMeta($table, $idColumn, $objectColumn, $resolver, $map, $dryRun);
        }

        $affected += $this->migrateOptions($resolver, $map, $dryRun);
        $affected += $this->migrateBlocks($map, $dryRun);

        return $affected;
    }

    /**
     * References that matched no field and no map entry in the last run, e.g. fields that no longer exist.
     */
    public function getSkipped(): int
    {
        return $this->skipped;
    }

    private function migrateMeta(string $table, string $idColumn, string $objectColumn, KeyResolver $resolver, array $map, bool $dryRun): int
    {
        $affected = 0;

        foreach ($this->references($table, $idColumn, $objectColumn, 'meta_key', 'meta_value') as $row) {
            $readValue = fn(string $name) => $this->readValue($table, $objectColumn, 'meta_key', 'meta_value', $name, $row->object_id);
            $newKey = $resolver->resolve(substr($row->name, 1), $readValue);

            $affected += $this->update($table, $idColumn, 'meta_value', $row, $newKey ?? $map[$row->value] ?? null, $dryRun);
        }

        return $affected;
    }

    /**
     * Option references are stored as `_{post_id}_{name}`, where the post id is `options` or a custom options page id.
     */
    private function migrateOptions(KeyResolver $resolver, array $map, bool $dryRun): int
    {
        $table = $this->wpdb->options;
        $affected = 0;

        foreach ($this->references($table, 'option_id', null, 'option_name', 'option_value') as $row) {
            $newKey = null;
            $offset = 1;

            while ($newKey === null && ($separator = strpos($row->name, '_', $offset)) !== false) {
                $prefix = substr($row->name, 1, $separator);
                $readValue = fn(string $name) => $this->readValue($table, null, 'option_name', 'option_value', $prefix . $name);
                $newKey = $resolver->resolve(substr($row->name, $separator + 1), $readValue);
                $offset = $separator + 1;
            }

            $affected += $this->update($table, 'option_id', 'option_value', $row, $newKey ?? $map[$row->value] ?? null, $dryRun);
        }

        return $affected;
    }

    /**
     * ACF blocks store references in the block comment JSON, e.g. "_title":"field_hero_title".
     */
    private function migrateBlocks(array $map, bool $dryRun): int
    {
        $wpdb = $this->wpdb;
        $affected = 0;

        foreach ($map as $oldKey => $newKey) {
            $quotedOld = '"' . $oldKey . '"';
            $contains = '%' . $wpdb->esc_like($quotedOld) . '%';

            $affected += (int) $wpdb->query($dryRun
                ? $wpdb->prepare("SELECT 1 FROM {$wpdb->posts} WHERE post_content LIKE %s", $contains)
                : $wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s) WHERE post_content LIKE %s", $quotedOld, '"' . $newKey . '"', $contains));
        }

        return $affected;
    }

    private function references(string $table, string $idColumn, ?string $objectColumn, string $nameColumn, string $valueColumn): array
    {
        $wpdb = $this->wpdb;
        $objectSelect = $objectColumn ? ", {$objectColumn} AS object_id" : '';

        return $wpdb->get_results($wpdb->prepare(
            "SELECT {$idColumn} AS id{$objectSelect}, {$nameColumn} AS name, {$valueColumn} AS value FROM {$table} WHERE {$nameColumn} LIKE %s AND {$valueColumn} LIKE %s",
            $wpdb->esc_like('_') . '%',
            $wpdb->esc_like('field_') . '%'
        ));
    }

    private function readValue(string $table, ?string $objectColumn, string $nameColumn, string $valueColumn, string $name, mixed $objectId = null): mixed
    {
        $cacheKey = "{$table}:{$objectId}:{$name}";

        if (!array_key_exists($cacheKey, $this->valueCache)) {
            $wpdb = $this->wpdb;

            $this->valueCache[$cacheKey] = $objectColumn
                ? $wpdb->get_var($wpdb->prepare("SELECT {$valueColumn} FROM {$table} WHERE {$objectColumn} = %s AND {$nameColumn} = %s LIMIT 1", $objectId, $name))
                : $wpdb->get_var($wpdb->prepare("SELECT {$valueColumn} FROM {$table} WHERE {$nameColumn} = %s LIMIT 1", $name));
        }

        return $this->valueCache[$cacheKey];
    }

    private function update(string $table, string $idColumn, string $valueColumn, object $row, ?string $newKey, bool $dryRun): int
    {
        if ($newKey === null) {
            $this->skipped++;

            return 0;
        }

        if ($newKey === $row->value) {
            return 0;
        }

        if (!$dryRun) {
            $this->wpdb->update($table, [$valueColumn => $newKey], [$idColumn => $row->id]);
        }

        return 1;
    }
}
