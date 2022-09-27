<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

class FlexibleContent extends Field
{
    public string $button_label = 'Add Row';

    public array $layouts = [];

    public int $min = 0;

    public int $max = 0;

    protected function setType(): void
    {
        $this->type = 'flexible_content';
    }

    public function setButtonLabel(string $button_label): self
    {
        $this->button_label = $button_label;

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

    public function addLayout(FlexibleLayout $layout): self
    {
        $this->layouts[$layout->key] = $layout;

        return $this;
    }

    public function build(string $name = ''): array
    {
        $this->setKey($name . '_' . $this->key);

        foreach ($this->layouts as $layout) {
            $layout = $layout->build();
        }

        return json_decode(json_encode($this), true);
    }
}
