<?php

namespace Joren\ACFBuilder\Fields;

use Joren\ACFBuilder\Field;

class Text extends Field
{
    public string $default_value = '';

    public string $placeholder = '';

    public string $prepend = '';

    public string $append = '';

    public string $maxlength = '';

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        parent::__construct($label, $name, $key);
    }

    public function setType(): void
    {
        $this->type = 'text';
    }

    public function setDefaultValue(string $value): self
    {
        $this->default_value = $value;

        return $this;
    }

    public function setPlaceholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }

    public function setPrepend(string $value): self
    {
        $this->prepend = $value;

        return $this;
    }

    public function setAppend(string $value): self
    {
        $this->append = $value;

        return $this;
    }

    public function setMaxLength(string $value): self
    {
        $this->maxlength = $value;

        return $this;
    }
}
