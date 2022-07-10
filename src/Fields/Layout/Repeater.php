<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

class Repeater extends Field
{
    public bool $collapsed = false;

    public int $min = 0;

    public int $max = 0;

    public string $layout = 'block';

    public string $button_label;

    public array $sub_fields;

    public function  addSubField(Field $field): self
    {
        echo $this->key;
        echo $this->name;
        $this->sub_fields[] = $field;

        return $this;
    }

    protected function setType(): void
    {
        $this->type = 'repeater';
    }

    public function build()
    {
        foreach ($this->sub_fields as $field) {
            $field->onBuild($this->name);
        }

        return json_decode(json_encode($this), true);
    }
}
