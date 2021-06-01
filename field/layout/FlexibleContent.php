<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\ButtonLabel;
use ACFBuilder\Field\Helpers\Layouts;
use ACFBuilder\Field\Helpers\Max;
use ACFBuilder\Field\Helpers\Min;

class FlexibleContent extends Field
{
    use Layouts;
    use ButtonLabel;
    use Min;
    use Max;

    public function setType()
    {
        $this->type = 'flexible_content';
    }
}
