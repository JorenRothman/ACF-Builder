<?php

use Joren\ACFBuilder\FieldGroup;
use Joren\ACFBuilder\Fields\Basic\Text;
use Joren\ACFBuilder\Fields\Layout\Repeater;

require_once __DIR__ . '/vendor/autoload.php';

$fieldGroup = new FieldGroup('my test field group');

$repeater = new Repeater('repeater');

$repeater->addSubField(new Text('text'));

$fieldGroup->addField($repeater);

echo "<pre>";
print_r($fieldGroup->build());
echo "</pre>";
