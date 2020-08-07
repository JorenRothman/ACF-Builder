<?php

namespace ACFBuilder\Field\Choice;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\Choices;
use ACFBuilder\Field\Helpers\Layout;
use ACFBuilder\Field\Helpers\ReturnFormat;

class ButtonGroup extends Field
{
    use ReturnFormat;
    use Choices;
    use AllowNull;
    use Layout;

    public function setType()
    {
        $this->type = 'button_group';
    }
}
