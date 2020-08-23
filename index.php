<?php

require(__DIR__ . '/vendor/autoload.php');

use ACFBuilder\Enum\Operator;
use ACFBuilder\Field\Basic\Email;
use ACFBuilder\Field\Basic\Text;
use ACFBuilder\Field\Choice\ButtonGroup;
use ACFBuilder\Field\Choice\Checkbox;
use ACFBuilder\Field\Choice\RadioButton;
use ACFBuilder\Field\Choice\Select;
use ACFBuilder\Field\Choice\TrueFalse;
use ACFBuilder\Field\ConditionalLogicItem;
use ACFBuilder\Field\FieldConditionalLogic;
use ACFBuilder\FieldGroup\FieldGroup;
use ACFBuilder\FieldGroup\FieldGroupHideOnScreen;
use ACFBuilder\FieldGroup\FieldGroupInstructionPlacement;
use ACFBuilder\FieldGroup\FieldGroupLabelPlacement;
use ACFBuilder\FieldGroup\FieldGroupLocation;
use ACFBuilder\FieldGroup\FieldGroupLocations;
use ACFBuilder\FieldGroup\FieldGroupPosition;
use ACFBuilder\FieldGroup\FieldGroupStyle;

$fieldGroup = new FieldGroup('test Is Fine');

$textField = new Text('Text Field');

$textField->setInstructions('Hello');

$emailField = new Email('Email Field');
$fieldGroup->addField($emailField);
$fieldGroup->addField($textField);

$newText = new Text('lol');

$fieldGroup->addField($newText);



$trueFalseField = new TrueFalse('True False Field');

$trueFalseField2 = new TrueFalse('Boolean');

$trueFalseField2->setDefaultValue(true);
$trueFalseField->setUI(true);
$trueFalseField->setUIOnText('Hello');

$fieldGroup->addField($trueFalseField);
$fieldGroup->addField($trueFalseField2);

$select = new Select('Select field');

$select->setChoices([
    'test' => 'test message'
]);

$fieldGroup->addField($select);

$radioButton = new RadioButton('Radio Button');

$radioButton->setLayout('vertical');

$radioButton->setChoices([
    'test' => 'test button',
    'test' => 'test button',
]);

$fieldGroup->addField($radioButton);

$checkbox = new Checkbox('checkbox');

$checkbox->setChoices([
    'test' => 'test box'
]);

$fieldGroup->addField($checkbox);

$buttonGroup = new ButtonGroup('Button Group');

$buttonGroup->setChoices([
    'test' => 'test button',
    'test2' => 'test button'
]);

$fieldGroup->addField($buttonGroup);

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

$conditionalItem = new ConditionalLogicItem($trueFalseField, Operator::EQUALS, true);

$conditionalItems = new FieldConditionalLogic();

$conditionalItems->addItem($conditionalItem);

$textField->addConditionalLogic($conditionalItems);

$fieldGroup->register();
