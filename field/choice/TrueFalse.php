<?php

namespace ACFBuilder\Field\Choice;

use ACFBuilder\Field\Field;

/**
 * True False Field
 */
class TrueFalse extends Field
{
    protected function setType()
    {
        $this->type = 'true_false';
    }
}
