<?php

namespace JorenRothman\ACFBuilder;

/**
 * How field keys are generated.
 *
 * LEGACY: the 3.x scheme, e.g. field_field_hero_field_cta_field_title.
 * PATH:   the path of names from the field group down, e.g. field_hero_cta_title. Default since 4.0.
 *
 * @package JorenRothman\ACFBuilder
 */
final class KeyStrategy
{
    public const LEGACY = 'legacy';

    public const PATH = 'path';

    private static string $default = self::PATH;

    /**
     * Set the strategy used when none is given.
     *
     * @param 'legacy'|'path' $strategy
     * @return void
     */
    public static function setDefault(string $strategy): void
    {
        self::assertValid($strategy);

        self::$default = $strategy;
    }

    /**
     * @return string
     */
    public static function getDefault(): string
    {
        return self::$default;
    }

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
