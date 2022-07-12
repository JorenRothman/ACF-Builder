<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;
use Joren\ACFBuilder\Util\StringUtil;

class FlexibleLayout
{
    public $key = '';

    public $name = '';

    public $label = '';

    public $display = 'block';

    public $sub_fields = [];

    public $min = 0;

    public $max = 0;

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
        $this->min = $min;

        return $this;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

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
