<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;
use Joren\ACFBuilder\Util\StringUtil;

class FlexibleLayout
{
    public string $key = '';

    public string $name = '';

    public string $label = '';

    public string $display = 'block';

    public array $sub_fields = [];

    public string $min = '';

    public string $max = '';

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = $label;
        $this->name = StringUtil::nameFormat($name ?? $label);

        $this->setKey($key ?? $this->name);
    }

    /**
     * Set key for a flexible layout.
     *
     * @param string $value
     * @return void
     */
    protected function setKey(string $value): void
    {
        $this->key = 'layout_' . $value;
    }

    public function addSubField(Field $field): self
    {
        $this->sub_fields[] = $field;

        return $this;
    }

    public function setMin(int $min): self
    {
        $this->min = (string) $min;

        return $this;
    }

    public function setMax(int $max): self
    {
        $this->max = (string) $max;

        return $this;
    }

    public function setDisplay(string $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function build()
    {
        foreach ($this->sub_fields as $field) {
            $field->build($this->key);
        }

        return json_decode(json_encode($this), true);
    }
}
