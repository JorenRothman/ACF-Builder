<?php

namespace ACFBuilder\Field\Helpers;

trait Maxlength
{
    public $maxlength;

    public function setMaxlength($maxlength)
    {
        $this->maxlength = $maxlength;
    }
}
