<?php

namespace ACFBuilder\Fields;

class ImageField extends FileField
{
    public $minWidth = 0;

    public $minHeight = 0;

    public $maxWidth = 0;

    public $maxHeight = 0;

    public function setType()
    {
        $this->type = 'image';
    }

    public function setMinWidth($minWidth)
    {
        $this->minWidth = (int) $minWidth;
    }

    public function setMinHeight($minHeight)
    {
        $this->minHeight = (int) $minHeight;
    }

    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = (int) $maxWidth;
    }

    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = (int) $maxHeight;
    }
}
