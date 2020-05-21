<?php

namespace ACFBuilder\Fields;

use ACFBuilder\Util\Key;

class FlexibleContentField extends Field
{
    public $layouts = [];

    public $min = 0;

    public $max = 0;

    public $layout = 'block';

    public $buttonLabel = 'Add Row';

    public function setType()
    {
        $this->type = 'flexible_content';
    }

    public function addLayout($layout)
    {
        $this->layouts[$layout->key] = $layout;
    }

    public function setMin($min)
    {
        $this->min = intval($min);
    }

    public function setMax($max)
    {
        $this->max = intval($max);
    }

    public function setButtonLabel($buttonLabel)
    {
        $this->buttonLabel = $buttonLabel;
    }
}
