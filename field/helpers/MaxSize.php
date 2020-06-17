<?php

namespace ACFBuilder\Field\Helpers;

trait MaxSize
{
    public $maxSize;

    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
    }
}
