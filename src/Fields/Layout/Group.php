<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;

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
        $this->setKey($name . '_' . $this->key);

        foreach ($this->sub_fields as $field) {
            $field->build($this->key);
        }

        return parent::build();
    }
}
