<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;

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

    public function setButtonLabel(string $button_label): static
    {
        $this->button_label = $button_label;

        return $this;
    }

    public function setMin(int $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function setMax(int $max): static
    {
        $this->max = $max;

        return $this;
    }

    public function addLayout(FlexibleLayout $layout): static
    {
        $this->layouts[$layout->key] = $layout;

        return $this;
    }

    public function collectKeys(string $name = ''): array
    {
        $keys = parent::collectKeys($name);

        foreach ($this->layouts as $layout) {
            $keys += $layout->collectKeys();
        }

        return $keys;
    }

    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectKeys($name);

        $builtLayouts = [];
        foreach ($this->layouts as $key => $layout) {
            $builtLayouts[$key] = $layout->build($keys);
        }

        $data = parent::build($name, $keys);
        $data['layouts'] = $builtLayouts;

        return $data;
    }
}
