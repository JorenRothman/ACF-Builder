<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\Util\StringUtil;

class FlexibleLayout
{
    public string $key = '';

    public string $name = '';

    public string $label = '';

    public string $display = 'block';

    public array $sub_fields = [];

    public int $min = 0;

    public int $max = 0;

    public static function make(string $label, ?string $name = null, ?string $key = null): static
    {
        return new static($label, $name, $key);
    }

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = $label;
        $this->name = StringUtil::nameFormat($name ?? $label);

        $this->setKey($key ?? $this->name);
    }

    protected function setKey(string $value): void
    {
        $this->key = 'layout_' . $value;
    }

    public function addSubField(Field ...$fields): self
    {
        array_push($this->sub_fields, ...$fields);

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

    /**
     * @param 'block'|'table'|'row' $display
     */
    public function setDisplay(string $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function build(): array
    {
        $builtSubFields = array_map(
            fn(Field $field) => $field->build($this->key),
            $this->sub_fields
        );

        $data = json_decode(json_encode($this), true);
        $data['sub_fields'] = $builtSubFields;

        return $data;
    }
}
