<?php

namespace ACFBuilder\Field\Helpers;

trait AllowCustom
{
    public $allowCustom;

    public function setAllowCustom($allowCustom)
    {
        $this->allowCustom = $allowCustom;
    }
}
