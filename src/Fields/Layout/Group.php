<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

class Group extends Field
{
    public string $layout = 'block';

    public array $sub_fields;

    protected function setType(): void
    {
        $this->type = 'group';
    }

    /**
     * Add a sub field to the group
     *
     * @param Field $field
     * @return self
     */
    public function addSubField(Field $field): self
    {
        $this->sub_fields[] = $field;

        return $this;
    }

    /**
     * Build the group
     *
     * @return array
     */
    public function build()
    {
        foreach ($this->sub_fields as $field) {
            $field->onBuild($this->key);
        }

        return json_decode(json_encode($this), true);
    }
}
