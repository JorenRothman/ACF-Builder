<?php

namespace JorenRothman\ACFBuilder;

/**
 * Resolves the final key of a field or layout through its parents, so $field->key is always the built key.
 *
 * Requires resolveKey(string $scope, ?string $strategy) and resolveScope(string $scope, ?string $strategy).
 *
 * @internal
 * @package JorenRothman\ACFBuilder
 */
trait ResolvesKey
{
    protected ?KeyParent $parent = null;

    /**
     * @internal Called when this is attached to a parent.
     *
     * @param KeyParent $parent
     * @return void
     */
    public function setParent(KeyParent $parent): void
    {
        $this->parent = $parent;
    }

    public function getKeyStrategy(): string
    {
        return $this->parent?->getKeyStrategy() ?? KeyStrategy::getDefault();
    }

    public function getChildScope(string $strategy): string
    {
        return $this->resolveScope($this->getParentScope($strategy), $strategy);
    }

    /**
     * Get the key this is built with, given its current parents.
     *
     * @return string
     */
    public function getKey(): string
    {
        $strategy = $this->getKeyStrategy();

        return $this->resolveKey($this->getParentScope($strategy), $strategy);
    }

    protected function getParentScope(string $strategy): string
    {
        return $this->parent?->getChildScope($strategy) ?? '';
    }

    public function __get(string $property): mixed
    {
        if ($property === 'key') {
            return $this->getKey();
        }

        trigger_error('Undefined property: ' . static::class . '::$' . $property, E_USER_WARNING);

        return null;
    }

    public function __isset(string $property): bool
    {
        return $property === 'key';
    }
}
