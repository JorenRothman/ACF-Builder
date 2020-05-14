<?php

namespace ACFBuilder\Fields;

class EmailField extends Field
{
    public function setType()
    {
        $this->type = 'email';
    }
}
