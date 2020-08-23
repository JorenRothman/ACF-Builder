<?php

require(__DIR__ . '/vendor/autoload.php');

use ACFBuilder\Enum\Operator;
use ACFBuilder\Field\Basic\Email;
use ACFBuilder\Field\Basic\Number;
use ACFBuilder\Field\Basic\Password;
use ACFBuilder\Field\Basic\Range;
use ACFBuilder\Field\Basic\Text;
use ACFBuilder\Field\Basic\TextArea;
use ACFBuilder\Field\Basic\URL;
use ACFBuilder\Field\Choice\ButtonGroup;
use ACFBuilder\Field\Choice\Checkbox;
use ACFBuilder\Field\Choice\RadioButton;
use ACFBuilder\Field\Choice\Select;
use ACFBuilder\Field\Choice\TrueFalse;
use ACFBuilder\Field\ConditionalLogicItem;
use ACFBuilder\Field\Content\File;
use ACFBuilder\Field\Content\Gallery;
use ACFBuilder\Field\Content\Image;
use ACFBuilder\Field\FieldConditionalLogic;
use ACFBuilder\Field\Layout\FlexibleContent;
use ACFBuilder\Field\Layout\FlexibleLayout;
use ACFBuilder\Field\Layout\Repeater;
use ACFBuilder\FieldGroup\FieldGroup;
use ACFBuilder\FieldGroup\FieldGroupHideOnScreen;
use ACFBuilder\FieldGroup\FieldGroupInstructionPlacement;
use ACFBuilder\FieldGroup\FieldGroupLabelPlacement;
use ACFBuilder\FieldGroup\FieldGroupLocation;
use ACFBuilder\FieldGroup\FieldGroupLocations;
use ACFBuilder\FieldGroup\FieldGroupPosition;
use ACFBuilder\FieldGroup\FieldGroupStyle;

$fieldGroup = new FieldGroup('test Is Fine');

$repeater = new Repeater('repeat');

$text = new Text('text');

$repeater->addSubField($text);

$repeater->setLayout('block');

$fieldGroup->addField($repeater);


$flexibleContent = new FlexibleContent('Flex content');

$flexibleLayout = new FlexibleLayout('Layout 1');

$text2 = new Text('text 2');

$flexibleLayout->addSubField($text2);

$flexibleContent->addLayout($flexibleLayout);

$fieldGroup->addField($flexibleContent);


$fieldGroupLocations = new FieldGroupLocations;

$fieldGroupLocation = new FieldGroupLocation('post_type', '==', 'post');

$fieldGroupLocations->addLocation($fieldGroupLocation);

$fieldGroup->addLocation($fieldGroupLocations);

$fieldGroup->setPosition(FieldGroupPosition::NORMAL);

$fieldGroup->setLabelPlacement(FieldGroupLabelPlacement::TOP);

$fieldGroup->setStyle(FieldGroupStyle::STANDARD);

$fieldGroup->setInstructionPlacement(FieldGroupInstructionPlacement::LABEL);

$hideOnScreen = new FieldGroupHideOnScreen;

$hideOnScreen->setTheContent();

$fieldGroup->setHideOnScreen($hideOnScreen);


$fieldGroup->register();
