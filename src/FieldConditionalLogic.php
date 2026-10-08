<?php

namespace JorenRothman\ACFBuilder;

use JorenRothman\ACFBuilder\Util\StringUtil;

class FieldConditionalLogic
{
    public array $conditionalLogic;

    public function __construct()
    {
        $this->conditionalLogic = [[]];

        return $this;
    }

    private function getCurrentConditionalLogicIndex(): int
    {
        return count($this->conditionalLogic) - 1;
    }

    /**
     * @param '=='|'!='|'>'|'<'|'>='|'<='|'contains'|'not_contains'|'pattern' $operator
     */
    public function and(Field $field, string $operator, mixed $value = null): static
    {
        $currentConditionalLogicIndex = $this->getCurrentConditionalLogicIndex();

        if (is_bool($value)) {
            $value = $value ? '1' : '0';
        }

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['field' => $field, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    /**
     * @param '=='|'!='|'>'|'<'|'>='|'<='|'contains'|'not_contains'|'pattern' $operator
     */
    public function or(Field $field, string $operator, mixed $value = null): static
    {
        if (!empty($this->conditionalLogic[$this->getCurrentConditionalLogicIndex()])) {
            $this->conditionalLogic[] = [];
        }

        $currentConditionalLogicIndex = $this->getCurrentConditionalLogicIndex();

        if (is_bool($value)) {
            $value = $value ? '1' : '0';
        }

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['field' => $field, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    /**
     * @param string $name
     * @param array<int, string> $keys Built keys of all fields in the tree, see Field::collectKeys().
     */
    public function build(string $name = '', array $keys = [])
    {
        return array_map(function ($conditionalLogic) use ($name, $keys) {
            return array_map(function ($conditionalLogicItem) use ($name, $keys) {
                return [
                    'field' => is_object($conditionalLogicItem['field']) ? $this->resolveKey($conditionalLogicItem['field'], $name, $keys) : '',
                    'operator' => $conditionalLogicItem['operator'],
                    'value' => $conditionalLogicItem['value'],
                ];
            }, $conditionalLogic);
        }, $this->conditionalLogic);
    }

    private function resolveKey(Field $field, string $name, array $keys): string
    {
        if ($keys) {
            return $keys[spl_object_id($field)] ?? $field->key;
        }

        return $name
            ? 'field_' . StringUtil::nameFormat($name . '_' . $field->key)
            : $field->key;
    }
}
