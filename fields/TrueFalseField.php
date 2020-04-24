<?php

namespace ACFBuilder\Fields;

class TrueFalseField extends Field
{
    public function setType()
    {
        $this->type = 'true_false';
    }
}
