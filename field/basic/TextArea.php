<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Maxlength;
use ACFBuilder\Field\Helpers\NewLines;
use ACFBuilder\Field\Helpers\Placeholder;
use ACFBuilder\Field\Helpers\Rows;

class TextArea extends Field
{
    use DefaultValue;
    use Placeholder;
    use Maxlength;
    use Rows;
    use NewLines;

    protected function setType()
    {
        $this->type = 'textarea';
    }
}
