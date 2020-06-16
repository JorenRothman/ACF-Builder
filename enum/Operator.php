<?php

namespace ACFBuilder\Enum;

abstract class Operator
{
    const EQUALS = '==';

    const NOT_EQUALS = '!=';

    const HAS_ANY_VALUE = '!=empty';

    const HAS_NO_VALUE = '==empty';

    const MATCHES_PATTERN = '==pattern';

    const CONTAINS = '==contains';
}
