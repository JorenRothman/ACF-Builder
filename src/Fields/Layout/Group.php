<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\KeyStrategy;

class Group extends Field
{
    public string $layout = 'block';

    public array $sub_fields = [];

    protected function setType(): void
    {
        $this->type = 'group';
    }

    public function addSubField(Field ...$fields): static
    {
        foreach ($fields as $field) {
            $field->setParent($this);
        }

        array_push($this->sub_fields, ...$fields);

        return $this;
    }

    /**
     * @param 'row'|'column'|'block' $layout
     */
    public function setLayout(string $layout): static
    {
        $this->layout = $layout;

        return $this;
    }

    public function collectKeys(string $scope = '', ?string $strategy = null): array
    {
        $strategy ??= KeyStrategy::getDefault();
        $keys = parent::collectKeys($scope, $strategy);
        $ownScope = $this->resolveScope($scope, $strategy);

        foreach ($this->sub_fields as $field) {
            $keys += $field->collectKeys($ownScope, $strategy);
        }

        return $keys;
    }

    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectRootKeys($name);
        $ownKey = $keys[spl_object_id($this)];

        $builtSubFields = array_map(
            fn(Field $field) => $field->build($ownKey, $keys),
            $this->sub_fields
        );

        $data = parent::build($name, $keys);
        $data['sub_fields'] = $builtSubFields;

        return $data;
    }
}
