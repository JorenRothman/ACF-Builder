<?php

namespace Joren\ACFBuilder\Fields\JQuery;

use Joren\ACFBuilder\Field;

abstract class JQueryField extends Field
{
    protected function searchDay(string $day): int
    {
        $days = [
            'sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
        ];

        if (in_array($day, $days)) {
            return array_search($day, $days);
        }

        return 1;
    }
}
