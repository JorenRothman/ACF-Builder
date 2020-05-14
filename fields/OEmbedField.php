<?php

namespace ACFBuilder\Fields;

class OEmbedField extends Field
{
    public $width = '';

    public $height = '';

    public function setType()
    {
        $this->type = 'oembed';
    }

    public function setWidth($width)
    {
        $this->width = (string) $width;
    }

    public function setHeight($height)
    {
        $this->height = (string) $height;
    }
}
