<?php

namespace Joren\ACFBuilder;

class FieldConditionalLogic
{
    public array $conditionalLogic;

    public function __construct()
    {
        $this->conditionalLogic = [[]];
    }

    private function getCurrentConditionalLogicIndex(): int
    {
        return count($this->conditionalLogic) - 1;
    }

    public function and(Field $field, string $operator, string $value): self
    {
        $currentConditionalLogicIndex = $this->getCurrentConditionalLogicIndex();

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['param' => $field->key, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    public function or(Field $field, string $operator, string $value): self
    {
        if (!empty($this->locations[$this->getCurrentConditionalLogicIndex()])) {
            $this->conditionalLogic[] = [];
        }

        $currentConditionalLogicIndex = $this->getCurrentConditionalLogicIndex();

        $this->conditionalLogic[$currentConditionalLogicIndex][] = ['param' => $field->key, 'operator' => $operator, 'value' => $value];

        return $this;
    }
}
