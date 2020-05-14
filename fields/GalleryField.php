<?php

namespace ACFBuilder\Fields;

class GalleryField extends ImageField
{
    public $min = 0;

    public $max = 0;

    public function setType()
    {
        $this->type = 'gallery';
    }

    public function setMin($min)
    {
        $this->min = $min;
    }

    public function setMax($max)
    {
        $this->max = $max;
    }
}
