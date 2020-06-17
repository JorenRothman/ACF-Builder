<?php

namespace ACFBuilder\Field\Helpers;

trait AllowNull
{
    public $allowNull;

    public function setAllowNull($allowNull)
    {
        $this->allowNull = $allowNull;
    }
}
