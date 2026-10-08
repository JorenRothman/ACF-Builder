<?php

namespace JorenRothman\ACFBuilder;

/**
 * How field keys are generated.
 *
 * LEGACY: the 3.x scheme, e.g. field_field_hero_field_cta_field_title.
 * PATH:   the path of names from the field group down, e.g. field_hero_cta_title.
 *
 * @package JorenRothman\ACFBuilder
 */
final class KeyStrategy
{
    public const LEGACY = 'legacy';

    public const PATH = 'path';

    /**
     * @param string $strategy
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function assertValid(string $strategy): void
    {
        if (!in_array($strategy, [self::LEGACY, self::PATH], true)) {
            throw new \InvalidArgumentException("Unknown key strategy '{$strategy}'.");
        }
    }
}
