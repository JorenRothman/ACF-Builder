<?php

namespace ACFBuilder\Field\Choice;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Message;
use ACFBuilder\Field\Helpers\UI;
use ACFBuilder\Field\Helpers\UIOffText;
use ACFBuilder\Field\Helpers\UIOnText;

/**
 * True False Field
 */
class TrueFalse extends Field
{
    use DefaultValue;
    use Message;
    use UI;
    use UIOnText;
    use UIOffText;

    protected function setType()
    {
        $this->type = 'true_false';
    }
}
