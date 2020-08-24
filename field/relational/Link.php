<?php

namespace ACFBuilder\Field\Relational;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\ReturnFormat;

class Link extends Field
{
    use ReturnFormat;

    public function setType()
    {
        $this->type = 'link';
    }
}
