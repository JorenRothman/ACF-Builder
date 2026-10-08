<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\KeyStrategy;

class Repeater extends Field
{
    public string $collapsed = '';

    public int $min = 0;

    public int $max = 0;

    public string $layout = 'block';

    public string $button_label = 'Add Row';

    public array $sub_fields = [];

    protected ?Field $collapsedField = null;

    public function addSubField(Field ...$fields): static
    {
        array_push($this->sub_fields, ...$fields);

        return $this;
    }

    protected function setType(): void
    {
        $this->type = 'repeater';
    }

    public function setCollapsed(Field $field): static
    {
        $this->collapsed = $field->key;
        $this->collapsedField = $field;

        return $this;
    }

    /**
     * @param 'table'|'row'|'block' $layout
     */
    public function setLayout(string $layout): static
    {
        $this->layout = $layout;

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

    public function setButtonLabel(string $button_label): static
    {
        $this->button_label = $button_label;

        return $this;
    }

    public function collectKeys(string $scope = '', string $strategy = KeyStrategy::LEGACY): array
    {
        $keys = parent::collectKeys($scope, $strategy);
        $ownScope = $this->resolveScope($scope, $strategy);

        foreach ($this->sub_fields as $field) {
            $keys += $field->collectKeys($ownScope, $strategy);
        }

        return $keys;
    }

    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectKeys($name);
        $ownKey = $keys[spl_object_id($this)] ?? $this->resolveKey($name);

        $collapsed = $this->collapsed;
        $builtSubFields = [];

        foreach ($this->sub_fields as $field) {
            $wasCollapsed = $field->key === $collapsed;
            $built = $field->build($ownKey, $keys);
            if ($wasCollapsed) {
                $collapsed = $built['key'];
            }
            $builtSubFields[] = $built;
        }

        $data = parent::build($name, $keys);
        $data['sub_fields'] = $builtSubFields;
        $data['collapsed'] = $this->collapsedField
            ? $keys[spl_object_id($this->collapsedField)] ?? $collapsed
            : $collapsed;

        return $data;
    }
}
