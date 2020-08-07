<?php

namespace ACFBuilder\Field\Choice;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AllowCustom;
use ACFBuilder\Field\Helpers\Choices;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Layout;
use ACFBuilder\Field\Helpers\ReturnFormat;
use ACFBuilder\Field\Helpers\SaveCustom;
use ACFBuilder\Field\Helpers\Toggle;

class Checkbox extends Field
{
    use DefaultValue;
    use ReturnFormat;
    use AllowCustom;
    use Toggle;
    use SaveCustom;
    use Choices;
    use Layout;


    public function setType()
    {
        $this->type = 'checkbox';
    }
}
