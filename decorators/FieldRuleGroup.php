<?php

namespace ACFBuilder\Decorators;

use ACFBuilder\IsBuildable;

class FieldRuleGroup implements IsBuildable
{
    public $rules = [];

    public function add($field, $operator, $value)
    {
        if (is_bool($value)) {
            $value = intval($value);
        }

        $rule = [
            'field' => $field->key,
            'operator' => $operator,
            'value' => $value
        ];

        array_push($this->rules, $rule);
    }

    public function build($suffix)
    {
        return $this->rules;
    }
}
