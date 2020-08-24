<?php

namespace ACFBuilder\Field\Jquery;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DisplayFormat;
use ACFBuilder\Field\Helpers\ReturnFormat;

class TimePicker extends Field
{
    use ReturnFormat;
    use DisplayFormat;

    public function setType()
    {
        $this->type = 'time_picker';
    }
}
