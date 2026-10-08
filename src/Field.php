<?php

namespace JorenRothman\ACFBuilder;

use JorenRothman\ACFBuilder\Util\ObjectUtil;
use JorenRothman\ACFBuilder\Util\StringUtil;

abstract class Field implements KeyParent
{
    use ResolvesKey;

    /**
     * Own key before resolving through parents. Reading $field->key returns getKey().
     */
    protected string $key;

    public string $label;

    public string $name;

    public string $type;

    public string $instructions = '';

    public int $required = 0;

    public mixed $conditional_logic = 0;

    public array $wrapper = ['width' => '', 'class' => '', 'id' => ''];

    /**
     * This field's own segment in a path key, see KeyStrategy::PATH.
     */
    protected string $keySegment;

    /**
     * Public properties holding child objects, which build() fills in separately.
     */
    protected const BUILT_SEPARATELY = [];

    public static function make(string $label, ?string $name = null, ?string $key = null): static
    {
        return new static($label, $name, $key);
    }

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = ucwords($label);
        $this->name = StringUtil::nameFormat($name ?? $label);

        $this->keySegment = StringUtil::nameFormat($key ?? $this->name);

        $this->setKey($key ?? $this->name);
        $this->setType();
    }

    /**
     * Set key for a field.
     *
     * @param string $value
     * @return static
     */
    protected function setKey(string $value): static
    {
        $this->key = 'field_' . StringUtil::nameFormat($value);

        return $this;
    }


    /**
     * Set the type of the field.
     *
     * @return void
     */
    abstract protected function setType(): void;

    /**
     * Set instruction for field
     *
     * @param string $value
     * @return static
     */
    public function setInstructions(string $value): static
    {
        $this->instructions = $value;

        return $this;
    }

    /**
     * Whether or not the field value is required.
     *
     * @param bool $value
     * @return static
     */
    public function setRequired(bool $value): static
    {
        $this->required = (int) $value;

        return $this;
    }

    /**
     * Conditionally hide or show this field based on other field's values.
     * Best to use the ACF UI and export to understand the array structure.
     *
     * @param FieldConditionalLogic $value
     * @return static
     */
    public function setConditionalLogic(FieldConditionalLogic $value): static
    {
        $this->conditional_logic = $value;

        return $this;
    }

    /**
     * An array of attributes given to the field element
     *
     * @param array $value
     * @return static
     */
    public function setWrapper(string $width, string $class = '', string $id = ''): static
    {
        $this->wrapper = ['width' => $width, 'class' => $class, 'id' => $id];

        return $this;
    }

    public function onAddToFieldGroup(FieldGroup $parent): void
    {
        $this->name = $parent->name . '_' . $this->name;
        $this->setParent($parent);
    }

    /**
     * Resolve the key this field gets when built under the given parent scope.
     *
     * @param string $scope Parent key (legacy) or parent path (path).
     * @param string|null $strategy Defaults to KeyStrategy::getDefault().
     * @return string
     */
    protected function resolveKey(string $scope, ?string $strategy = null): string
    {
        $strategy ??= KeyStrategy::getDefault();
        if ($strategy === KeyStrategy::PATH) {
            return 'field_' . $this->resolveScope($scope, $strategy);
        }

        return $scope
            ? 'field_' . StringUtil::nameFormat($scope . '_' . $this->key)
            : $this->key;
    }

    /**
     * Resolve the scope this field's sub fields are keyed under.
     *
     * @param string $scope Parent key (legacy) or parent path (path).
     * @param string|null $strategy Defaults to KeyStrategy::getDefault().
     * @return string
     */
    protected function resolveScope(string $scope, ?string $strategy = null): string
    {
        $strategy ??= KeyStrategy::getDefault();
        if ($strategy === KeyStrategy::PATH) {
            return $scope ? $scope . '_' . $this->keySegment : $this->keySegment;
        }

        return $this->resolveKey($scope, $strategy);
    }

    /**
     * Collect the built keys of this field and its descendants, indexed by object id.
     *
     * @param string $scope Parent key (legacy) or parent path (path).
     * @param string|null $strategy Defaults to KeyStrategy::getDefault().
     * @return array<int, string>
     */
    public function collectKeys(string $scope = '', ?string $strategy = null): array
    {
        $strategy ??= KeyStrategy::getDefault();
        return [spl_object_id($this) => $this->resolveKey($scope, $strategy)];
    }

    /**
     * Collect keys for a build started at this field.
     *
     * @param string $name Explicit parent scope, defaults to the scope of the attached parent.
     * @return array<int, string>
     */
    protected function collectRootKeys(string $name): array
    {
        $strategy = $this->getKeyStrategy();

        return $this->collectKeys($name !== '' ? $name : $this->getParentScope($strategy), $strategy);
    }

    /**
     * Build the field
     *
     * @param string $name
     * @param array<int, string> $keys Built keys of all fields in the tree, see collectKeys().
     * @return array
     */
    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectRootKeys($name);

        $hasConditionalLogic = $this->conditional_logic instanceof FieldConditionalLogic;
        $except = $hasConditionalLogic ? [...static::BUILT_SEPARATELY, 'conditional_logic'] : static::BUILT_SEPARATELY;

        $data = ['key' => $keys[spl_object_id($this)]] + ObjectUtil::toArray($this, $except);

        if ($hasConditionalLogic) {
            $data['conditional_logic'] = $this->conditional_logic->build($name, $keys);
        }

        return $data;
    }
}
