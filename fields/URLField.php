<?php

namespace ACFBuilder\Fields;

class URLField extends Field
{
    public function setType()
    {
        $this->type = 'url';
    }
}
