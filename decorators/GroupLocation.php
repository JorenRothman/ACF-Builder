<?php

namespace ACFBuilder\Decorators;

use ACFBuilder\IsBuildable;

class GroupLocation implements IsBuildable
{
    public $locations = [];

    public function add($param, $operator, $value)
    {
        if (is_bool($value)) {
            $value = intval($value);
        }

        $location = [
            'param' => $param,
            'operator' => $operator,
            'value' => $value
        ];

        array_push($this->locations, $location);
    }

    public function build()
    {
        return $this->locations;
    }
}
