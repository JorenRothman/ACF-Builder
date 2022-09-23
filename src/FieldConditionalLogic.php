<?php

namespace Joren\ACFBuilder;

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

    public function and(Field $field, string $operator, mixed $value): self
    {
        $currentConditionalLogicIndex = $this->getCurrentConditionalLogicIndex();

        if (is_bool($value)) {
            $value = $value ? '1' : '0';
        }

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['field' => $field, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    public function or(Field $field, string $operator, mixed $value): self
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

    public function build()
    {
        $this->conditionalLogic = array_map(function ($conditionalLogic) {
            return array_map(function ($conditionalLogicItem) {
                return [
                    'field' => $conditionalLogicItem['field']->key,
                    'operator' => $conditionalLogicItem['operator'],
                    'value' => $conditionalLogicItem['value'],
                ];
            }, $conditionalLogic);
        }, $this->conditionalLogic);

        return $this->conditionalLogic;
    }
}
