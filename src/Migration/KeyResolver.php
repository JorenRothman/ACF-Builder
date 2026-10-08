<?php

namespace JorenRothman\ACFBuilder\Migration;

/**
 * Resolves the field key a stored value belongs to from the name it is stored under.
 *
 * ACF stores `production_content_blocks_0_title` under its full name path, so the
 * field it belongs to can be found by walking the built fields, independent of
 * whatever key the reference held before.
 *
 * @package JorenRothman\ACFBuilder\Migration
 */
class KeyResolver
{
    /**
     * @param array<int, array> $fields Built top-level fields, see FieldGroup::build().
     */
    public function __construct(private array $fields)
    {
    }

    /**
     * @param string $name Stored value name, without the leading `_` of the reference.
     * @param callable(string): mixed $readValue Reads a stored value by name, used for flexible content layouts.
     * @return string|null The key, or null when no field matches.
     */
    public function resolve(string $name, callable $readValue): ?string
    {
        $field = $this->match($this->fields, $name);

        if (!$field) {
            return null;
        }

        return $this->resolveIn($field, $field['name'], substr($name, strlen($field['name'])), $readValue);
    }

    private function resolveIn(array $field, string $path, string $rest, callable $readValue): ?string
    {
        if ($rest === '') {
            return $field['key'];
        }

        if ($field['type'] === 'group') {
            $subField = $this->match($field['sub_fields'] ?? [], substr($rest, 1));

            return $subField
                ? $this->resolveIn($subField, $path . '_' . $subField['name'], substr($rest, 1 + strlen($subField['name'])), $readValue)
                : null;
        }

        if (!in_array($field['type'], ['repeater', 'flexible_content'], true) || !preg_match('/^_(\d+)_(.+)$/', $rest, $matches)) {
            return null;
        }

        [, $index, $rowRest] = $matches;

        $subFields = $field['type'] === 'flexible_content'
            ? $this->layoutSubFields($field, $readValue($path), (int) $index)
            : $field['sub_fields'] ?? [];

        $subField = $this->match($subFields, $rowRest);

        return $subField
            ? $this->resolveIn($subField, "{$path}_{$index}_{$subField['name']}", substr($rowRest, strlen($subField['name'])), $readValue)
            : null;
    }

    private function layoutSubFields(array $field, mixed $layouts, int $index): array
    {
        if (is_string($layouts)) {
            $layouts = @unserialize($layouts, ['allowed_classes' => false]);
        }

        $layoutName = is_array($layouts) ? ($layouts[$index] ?? null) : null;

        foreach ($field['layouts'] ?? [] as $layout) {
            if ($layout['name'] === $layoutName) {
                return $layout['sub_fields'] ?? [];
            }
        }

        return [];
    }

    /**
     * Find the field whose name is the longest prefix of $name, e.g. `title_link` over `title`.
     */
    private function match(array $fields, string $name): ?array
    {
        $best = null;

        foreach ($fields as $field) {
            if ($name !== $field['name'] && !str_starts_with($name, $field['name'] . '_')) {
                continue;
            }

            if (!$best || strlen($field['name']) > strlen($best['name'])) {
                $best = $field;
            }
        }

        return $best;
    }
}
