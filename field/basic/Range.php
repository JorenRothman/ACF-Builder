<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Append;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Max;
use ACFBuilder\Field\Helpers\Min;
use ACFBuilder\Field\Helpers\Prepend;
use ACFBuilder\Field\Helpers\Step;

class Range extends Field
{

    use DefaultValue;
    use Prepend;
    use Append;
    use Min;
    use Max;
    use Step;

    protected function setType()
    {
        $this->type = 'range';
    }
}
