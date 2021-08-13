<?php

namespace ACFBuilder\Field\Choice;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\UI;
use ACFBuilder\Field\Helpers\Ajax;
use ACFBuilder\Field\Helpers\Choices;
use ACFBuilder\Field\Helpers\Multiple;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\Placeholder;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\ReturnFormat;

/**
 * Select Field
 */
class Select extends Field
{
    use DefaultValue;
    use Placeholder;
    use ReturnFormat;
    use Choices;
    use AllowNull;
    use Ajax;
    use Multiple;
    use UI;

    protected function setType()
    {
        $this->type = 'select';
    }
}
