<?php

namespace Joren\ACFBuilder\Fields;

use Joren\ACFBuilder\Field;

class TrueFalse extends Field
{
    public mixed $default_value = false;

    public string $message = '';

    public bool $ui = false;

    public string $ui_on_text = '';

    public string $ui_off_text = '';

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        parent::__construct($label, $name, $key);
    }

    public function setType(): void
    {
        $this->type = 'true_false';
    }

    public function setMessage(string $value): self
    {
        $this->message = $value;

        return $this;
    }

    public function setUI(bool $value): self
    {
        $this->ui = $value;

        return $this;
    }

    public function setUiOnText(string $value): self
    {
        $this->ui_on_text = $value;

        return $this;
    }

    public function setUiOffText(string $value): self
    {
        $this->ui_off_text = $value;

        return $this;
    }
}
