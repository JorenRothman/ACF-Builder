<?php

namespace ACFBuilder\Field\Choice;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\Choices;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Layout;
use ACFBuilder\Field\Helpers\ReturnFormat;
use ACFBuilder\Field\Helpers\SaveOtherChoices;

class RadioButton extends Field
{
    use DefaultValue;
    use ReturnFormat;
    use Choices;
    use AllowNull;
    use Layout;
    use SaveOtherChoices;

    public function setType()
    {
        $this->type = 'radio';
    }
}
