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
     * Set the layout of the group
     * options: row, column, block
     *
     * @param string $layout
     * @return self
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Build the group
     *
     * @return array
     */
    public function build($name = ''): array
    {
        foreach ($this->sub_fields as $field) {
            $field->build($this->key);
        }

        return json_decode(json_encode($this), true);
    }
}
