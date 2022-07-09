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

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['field' => $field->key, 'operator' => $operator, 'value' => $value];

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

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['field' => $field->key, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    public function build()
    {
        return $this->conditionalLogic;
    }
}
