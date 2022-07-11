<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

class Group extends Field
{
    public string $layout = 'block';

    public array $sub_fields;

    public function addSubField(Field $field): self
    {
        $this->sub_fields[] = $field;

        return $this;
    }

    protected function setType(): void
    {
        $this->type = 'group';
    }

    public function build()
    {
        foreach ($this->sub_fields as $field) {
            $field->onBuild($this->key);
        }

        return json_decode(json_encode($this), true);
    }
}
