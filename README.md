Table of Contents
=================

- [Table of Contents](#table-of-contents)
- [Supported Fields](#supported-fields)
- [Usage](#usage)
  - [Creating A Field](#creating-a-field)
  - [Creating A Field Group](#creating-a-field-group)
  - [Adding A Field To Your Field Group](#adding-a-field-to-your-field-group)
  - [Creating A Group Location](#creating-a-group-location)
    - [AND Statement](#and-statement)
    - [OR Statement](#or-statement)
  - [Adding Conditional Logic To Your Field](#adding-conditional-logic-to-your-field)
  - [Register Your Field Group](#register-your-field-group)
  - [Getting Data In Templates](#getting-data-in-templates)

# Supported Fields
- Text
- Textarea
- Number
- Email
- URL
- Password
- WYSIWYG
- OEMBED
- Image
- File
- Gallery
- True False

# Usage
This small introduction will get you up and running with the ACF Builder

## Creating A Field
To create a field first pick a field type you want to create for example a text field. Start by first calling the correct class like so

```php
$myField = new TextField('My Field Name');
```

This will create a field object with the bare minimum set. To customize the field you can use all the different setters this objects provides you with. **ADD LINK TO PHP CODE DOC CLASS FIELD SETTERS**

## Creating A Field Group
To create a field group you can use the following class

```php
$myFieldGroup = new FieldGroup('My Field Group name');
```

## Adding A Field To Your Field Group
Adding a field to your field group is easing and only involves one function.

```php
$myFieldGroup->addField($myField);
```

## Creating A Group Location
When your are creating a field group you want to add a location so that it doesn't show up everywhere. This can be done with the following code

```php
$location = new GroupLocation();

$location->add('post_type', '==', 'post');

$myFieldGroup->addLocation($location);
```
### AND Statement
Simple Right? let's say you want to do an AND statement this can be done with the following code

```php
$location = new GroupLocation();

$location->add('post_type', '==', 'post');

$location->add('post_type', '==', 'my_post_type');

$myFieldGroup->addLocation($location);
```

### OR Statement
Does it support OR locations. Yes it supports this to adding an OR location can be done with the following code

```php
$location = new GroupLocation();

$location->add('post_type', '==', 'post');

$myFieldGroup->addLocation($location);

$otherLocation = new GroupLocation();

$location->add('post_type', '==', 'my_post_type');

$myFieldGroup->addLocation($otherLocation);
```

## Adding Conditional Logic To Your Field
To add conditional logic to your field you can use the following code

```php
$trueFalseField = new TrueFalseField('Title');
$textField = new TextField('Text');

$conditionalLogic = new FieldRuleGroup();

$conditionalLogic->>add($trueFalseField, '!=', 'true');

$textField->setConditionalLogic($conditionalLogic);
```

The code above will only show the text field when the true false field is false.

To do AND OR operators this works the same as with the group location.

## Register Your Field Group
When you're all done adding fields, locations and other settings it's time to register your field group. Registering is done in the following manor

```php
$myFieldGroup->register();
```

## Getting Data In Templates
To get the value of your newly created field(s). You simply take your field group and field name and combine them and replace all spaces and dashes with underscore.

An Example

```php
$myFieldGroup = new FieldGroup('My Field Group name');
$myField = new TextField('My Field Name');

$myFieldGroup->addField($myField);

$myFieldGroup->register();

// The Field Name will be my_field_group_name_my_field_name

get_field('my_field_group_name_my_field_name');
```
