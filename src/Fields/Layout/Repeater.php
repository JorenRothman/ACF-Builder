<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

class Repeater extends Field
{
    public string $collapsed = '';

    public int $min = 0;

    public int $max = 0;

    public string $layout = 'block';

    public string $button_label = 'Add Row';

    public array $sub_fields;

    /**
     * Add a sub field to the repeater
     * 
     * @param string $name
     * @return Repeater
     */
    public function addSubField(Field $field): self
    {
        $this->sub_fields[] = $field;

        return $this;
    }

    protected function setType(): void
    {
        $this->type = 'repeater';
    }

    public function setCollapsed(Field $field): self
    {
        $this->collapsed = $field->key;

        return $this;
    }

    /**
     * Set the minimum number of rows
     * 
     * @param int $min
     * @return Repeater
     */
    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Set the maximum number of rows
     * 
     * @param int $max
     * @return Repeater
     */
    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Set the layout of the repeater
     * options: table, row, block
     * 
     * @param string $layout
     * @return Repeater
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Set the button label
     *
     * @param string $button_label
     * @return self
     */
    public function setButtonLabel(string $button_label): self
    {
        $this->button_label = $button_label;

        return $this;
    }

    /**
     * Build the repeater
     * 
     * @return array
     */
    public function build(string $name = ''): array
    {
        $this->setKey($name . '_' . $this->key);

        foreach ($this->sub_fields as $field) {
            $isCollapsed = $field->key === $this->collapsed;

            $field->build($this->key);

            if ($isCollapsed) {
                $this->collapsed = $field->key;
            }
        }

        return json_decode(json_encode($this), true);
    }
}
