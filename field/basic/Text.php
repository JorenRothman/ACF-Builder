<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Append;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Maxlength;
use ACFBuilder\Field\Helpers\Placeholder;
use ACFBuilder\Field\Helpers\Prepend;

class Text extends Field
{
    use DefaultValue;
    use Placeholder;
    use Prepend;
    use Append;
    use Maxlength;

    protected function setType()
    {
        $this->type = 'text';
    }
}
