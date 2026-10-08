<?php

namespace JorenRothman\ACFBuilder;

/**
 * Anything fields can be attached to: field groups, fields with sub fields and flexible layouts.
 *
 * @internal
 * @package JorenRothman\ACFBuilder
 */
interface KeyParent
{
    /**
     * The key strategy of the field group at the root of the tree.
     *
     * @return string
     */
    public function getKeyStrategy(): string;

    /**
     * The scope children of this parent are keyed under, see Field::resolveKey().
     *
     * @param string $strategy
     * @return string
     */
    public function getChildScope(string $strategy): string;
}
