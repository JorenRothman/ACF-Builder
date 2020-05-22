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
            'field' => $field,
            'operator' => $operator,
            'value' => $value
        ];

        array_push($this->rules, $rule);
    }

    public function build()
    {
        $array = json_decode(json_encode($this), true);
        $returnArray = [];

        $rulesLength = count($array['rules']);

        for ($i = 0; $i < $rulesLength; $i++) {
            $fieldKey = $array['rules'][$i]['field']['key'];

            $returnArray[$i] = $array['rules'][$i];
            $returnArray[$i]['field'] = $fieldKey;
        }

        return $returnArray;
    }
}
