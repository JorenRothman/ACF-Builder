<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\Util\StringUtil;

class Repeater extends Field
{
    public string $collapsed = '';

    public int $min = 0;

    public int $max = 0;

    public string $layout = 'block';

    public string $button_label = 'Add Row';

    public array $sub_fields = [];

    public function addSubField(Field ...$fields): self
    {
        array_push($this->sub_fields, ...$fields);

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
     * @param 'table'|'row'|'block' $layout
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function setButtonLabel(string $button_label): self
    {
        $this->button_label = $button_label;

        return $this;
    }

    public function build(string $name = ''): array
    {
        $ownKey = $name
            ? 'field_' . StringUtil::nameFormat($name . '_' . $this->key)
            : $this->key;

        $collapsed = $this->collapsed;
        $builtSubFields = [];

        foreach ($this->sub_fields as $field) {
            $wasCollapsed = $field->key === $collapsed;
            $built = $field->build($ownKey);
            if ($wasCollapsed) {
                $collapsed = $built['key'];
            }
            $builtSubFields[] = $built;
        }

        $data = parent::build($name);
        $data['sub_fields'] = $builtSubFields;
        $data['collapsed'] = $collapsed;

        return $data;
    }
}
