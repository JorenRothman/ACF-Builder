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

    public function build()
    {
        $this->subFields = array_map(function ($subField) {
            $subField->fieldOnAdd($subField->name);

            return $subField->build();
        }, $this->subFields);

        if ($this->collapsed) {
            $this->collapsed = $this->collapsed->key;
        }

        return parent::build();
    }
}
