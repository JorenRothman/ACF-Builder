<?php

namespace Joren\ACFBuilder\Helpers;

use Joren\ACFBuilder\FieldGroup;

trait FieldHelper
{
    public function onAddToFieldGroup(FieldGroup $parent): void
    {
        $fieldGroupName = $parent->name;

        $this->name = $fieldGroupName . '_' . $this->name;
        $this->setKey($fieldGroupName . '_' . $this->key);
    }
}
