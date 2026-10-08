<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\KeyStrategy;

class FlexibleContent extends Field
{
    public string $button_label = 'Add Row';

    public array $layouts = [];

    protected const BUILT_SEPARATELY = ['layouts'];

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

    public function addLayout(FlexibleLayout ...$layouts): static
    {
        foreach ($layouts as $layout) {
            $layout->setParent($this);
        }

        array_push($this->layouts, ...$layouts);

        return $this;
    }

    public function collectKeys(string $scope = '', ?string $strategy = null): array
    {
        $strategy ??= KeyStrategy::getDefault();
        $keys = parent::collectKeys($scope, $strategy);
        $ownScope = $this->resolveScope($scope, $strategy);

        foreach ($this->layouts as $layout) {
            $keys += $layout->collectKeys($ownScope, $strategy);
        }

        return $keys;
    }

    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectRootKeys($name);

        $builtLayouts = [];
        foreach ($this->layouts as $layout) {
            $built = $layout->build($keys);
            $builtLayouts[$built['key']] = $built;
        }

        $data = parent::build($name, $keys);
        $data['layouts'] = $builtLayouts;

        return $data;
    }
}
