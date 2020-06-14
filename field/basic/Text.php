<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;

class Text extends Field
{
    protected function setType()
    {
        $this->type = 'text';
    }
}
