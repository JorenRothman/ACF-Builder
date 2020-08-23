<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Append;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Max;
use ACFBuilder\Field\Helpers\Min;
use ACFBuilder\Field\Helpers\Placeholder;
use ACFBuilder\Field\Helpers\Prepend;
use ACFBuilder\Field\Helpers\Step;

class Number extends Field
{
    use DefaultValue;
    use Placeholder;
    use Prepend;
    use Append;
    use Min;
    use Max;
    use Step;

    protected function setType()
    {
        $this->type = 'number';
    }
}
