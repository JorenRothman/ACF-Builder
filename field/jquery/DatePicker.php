<?php

namespace ACFBuilder\Field\Jquery;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DisplayFormat;
use ACFBuilder\Field\Helpers\FirstDay;
use ACFBuilder\Field\Helpers\ReturnFormat;

class DatePicker extends Field
{
    use ReturnFormat;
    use DisplayFormat;
    use FirstDay;

    public function setType()
    {
        $this->type = 'date_picker';
    }
}
