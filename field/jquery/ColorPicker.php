<?php

namespace ACFBuilder\Field\Jquery;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DefaultValue;

class ColorPicker extends Field
{
    use DefaultValue;

    public function setType()
    {
        $this->type = 'color_picker';
    }
}
