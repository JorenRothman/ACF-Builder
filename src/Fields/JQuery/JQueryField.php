<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

use JorenRothman\ACFBuilder\Field;

abstract class JQueryField extends Field
{
    /**
     * @param 'sunday'|'monday'|'tuesday'|'wednesday'|'thursday'|'friday'|'saturday' $day
     */
    protected function searchDay(string $day): int
    {
        $days = ['sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6];

        return $days[$day] ?? throw new \InvalidArgumentException("Invalid day: {$day}");
    }
}
