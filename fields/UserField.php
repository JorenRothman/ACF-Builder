<?php

namespace ACFBuilder\Fields;

class UserField extends Field
{
    public $role = [];

    public $allowNull = 0;

    public $multiple = 0;

    public function setType()
    {
        $this->type = 'user';
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setAllowNull($allowNull)
    {
        $this->allowNull = intval($allowNull);
    }

    public function setMultiple($multiple)
    {
        $this->multiple = intval($multiple);
    }
}
