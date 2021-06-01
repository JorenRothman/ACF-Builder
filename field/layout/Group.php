<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Layout;
use ACFBuilder\Field\Helpers\SubFields;

class Group extends Field
{
    use Layout;
    use SubFields;

    public function setType()
    {
        $this->type = 'group';
    }

    public function build()
    {
        $this->subFields = array_map(function ($subField) {
            $subField->fieldOnAdd($subField->name);

            return $subField->build();
        }, $this->subFields);

        return parent::build();
    }
}
