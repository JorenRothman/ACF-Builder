<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\ButtonLabel;
use ACFBuilder\Field\Helpers\Collapsed;
use ACFBuilder\Field\Helpers\Layout;
use ACFBuilder\Field\Helpers\Max;
use ACFBuilder\Field\Helpers\Min;
use ACFBuilder\Field\Helpers\SubFields;

class Repeater extends Field
{
    use Min;
    use Max;
    use Layout;
    use ButtonLabel;
    use SubFields;
    use Collapsed;

    public function setType()
    {
        $this->type = 'repeater';
    }
}
