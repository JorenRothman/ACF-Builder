<?php

namespace ACFBuilder\Field\Helpers;

trait MinSize
{
    public $minSize;

    public function setMinSize($minSize)
    {
        $this->minSize = $minSize;
    }
}
