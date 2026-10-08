<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;
use JorenRothman\ACFBuilder\KeyStrategy;
use JorenRothman\ACFBuilder\Util\StringUtil;

class FlexibleLayout
{
    public string $key = '';

    public string $name = '';

    public string $label = '';

    public string $display = 'block';

    public array $sub_fields = [];

    public int $min = 0;

    public int $max = 0;

    /**
     * This layout's own segment in a path key, see KeyStrategy::PATH.
     */
    protected string $keySegment;

    public static function make(string $label, ?string $name = null, ?string $key = null): static
    {
        return new static($label, $name, $key);
    }

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = $label;
        $this->name = StringUtil::nameFormat($name ?? $label);

        $this->keySegment = StringUtil::nameFormat($key ?? $this->name);

        $this->setKey($key ?? $this->name);
    }

    protected function setKey(string $value): void
    {
        $this->key = 'layout_' . $value;
    }

    public function addSubField(Field ...$fields): static
    {
        array_push($this->sub_fields, ...$fields);

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

    /**
     * @param 'block'|'table'|'row' $display
     */
    public function setDisplay(string $display): static
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Collect the built keys of this layout and its sub fields, indexed by object id.
     *
     * @param string $scope Parent path, only used by KeyStrategy::PATH.
     * @param string|null $strategy Defaults to KeyStrategy::getDefault().
     * @return array<int, string>
     */
    public function collectKeys(string $scope = '', ?string $strategy = null): array
    {
        $strategy ??= KeyStrategy::getDefault();
        if ($strategy === KeyStrategy::PATH) {
            $ownScope = $scope ? $scope . '_' . $this->keySegment : $this->keySegment;
            $keys = [spl_object_id($this) => 'layout_' . $ownScope];
        } else {
            $ownScope = $this->key;
            $keys = [spl_object_id($this) => $this->key];
        }

        foreach ($this->sub_fields as $field) {
            $keys += $field->collectKeys($ownScope, $strategy);
        }

        return $keys;
    }

    /**
     * @param array<int, string> $keys Built keys of all fields in the tree, see collectKeys().
     */
    public function build(array $keys = []): array
    {
        $keys = $keys ?: $this->collectKeys();
        $ownKey = $keys[spl_object_id($this)] ?? $this->key;

        $builtSubFields = array_map(
            fn(Field $field) => $field->build($ownKey, $keys),
            $this->sub_fields
        );

        $data = json_decode(json_encode($this), true);
        $data['key'] = $ownKey;
        $data['sub_fields'] = $builtSubFields;

        return $data;
    }
}
