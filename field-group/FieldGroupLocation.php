<?php

namespace ACFBuilder\FieldGroup;

use ACFBuilder\IsBuildable;
use ACFBuilder\Util\ObjectUtil;

class FieldGroupLocation
{
    public $param;

    public $operator;

    public $value;

    public function __construct($param, $operator, $value)
    {
        $this->param = $param;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function build()
    {
        return ObjectUtil::toArray($this);
    }
}
