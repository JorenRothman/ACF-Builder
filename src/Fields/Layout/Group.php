<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\Util\StringUtil;

class Group extends Field
{
    public string $layout = 'block';

    public array $sub_fields = [];

    protected function setType(): void
    {
        $this->type = 'group';
    }

    public function addSubField(Field ...$fields): self
    {
        array_push($this->sub_fields, ...$fields);

        return $this;
    }

    /**
     * @param 'row'|'column'|'block' $layout
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function build(string $name = ''): array
    {
        $ownKey = $name
            ? 'field_' . StringUtil::nameFormat($name . '_' . $this->key)
            : $this->key;

        $builtSubFields = array_map(
            fn(Field $field) => $field->build($ownKey),
            $this->sub_fields
        );

        $data = parent::build($name);
        $data['sub_fields'] = $builtSubFields;

        return $data;
    }
}
