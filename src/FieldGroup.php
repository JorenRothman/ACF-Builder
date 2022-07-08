<?php

namespace Joren\ACFBuilder;

use Joren\ACFBuilder\Util\StringUtil;

class FieldGroup
{
    public string $title;

    public string $name;

    public string $key;

    public int $menu_order = 0;

    public string $position = 'normal';

    public string $style = 'default';

    public string $label_placement = 'top';

    public string $instruction_placement = 'label';

    public string $hide_on_screen = '';

    public bool $active = true;

    public string $description;

    public bool $show_in_rest = false;

    public array $fields;

    public array $location;

    public function __construct(string $title, ?string $name = null, ?string $key = null)
    {
        $this->title = $title;
        $this->name = StringUtil::nameFormat($name ?? $title);

        $this->setKey($key ?? $this->name);
    }

    /**
     * Set key for field group.
     *
     * @param string $value
     * @return FieldGroup
     */
    public function setKey(string $value): self
    {
        $this->key = md5($value);

        return $this;
    }

    /**
     * Set the order in which the order of a fieldgroup is determined.
     *
     * @param integer $value
     * @return FieldGroup
     */
    public function setMenuOrder(int $value): self
    {
        $this->menu_order = $value;

        return $this;
    }

    /**
     * Set the meta box position of the field group.
     * 
     * options: normal, side
     *
     * @param string $value
     * @return FieldGroup
     */
    public function setPosition(string $value): self
    {
        $this->position = $value;

        return $this;
    }

    /**
     * Set style of the field group.
     * 
     * options: default, seamless
     *
     * @param string $value
     * @return FieldGroup
     */
    public function setStyle(string $value): self
    {
        $this->style = $value;

        return $this;
    }

    /**
     * Set the placement of the label.
     * 
     * options: top, left
     * 
     * @param string $value 
     * @return FieldGroup 
     */
    public function setLabelPlacement(string $value): self
    {
        $this->label_placement = $value;

        return $this;
    }

    /**
     * Set the placement of the instructions.
     * 
     * options: label, field
     *
     * @param string $value
     * @return FieldGroup
     */
    public function setInstructionPlacement(string $value): self
    {
        $this->instruction_placement = $value;

        return $this;
    }

    /**
     * Set the hide on screen option.
     * 
     * @param string $value 
     * @return FieldGroup 
     */
    public function setHideOnScreen(string $value): self
    {
        $this->hide_on_screen = $value;

        return $this;
    }

    /**
     * Set the active state of the field group.
     * 
     * @param boolean $value 
     * @return FieldGroup 
     */
    public function setActive(bool $value): self
    {
        $this->active = $value;

        return $this;
    }

    /**
     * Set the description of the field group.
     * 
     * @param string $value 
     * @return FieldGroup 
     */
    public function setDescription(string $value): self
    {
        $this->description = $value;

        return $this;
    }

    /**
     * Set the show in rest option.
     * 
     * @param bool $value 
     * @return FieldGroup 
     */
    public function setShowInRest(bool $value): self
    {
        $this->show_in_rest = $value;

        return $this;
    }

    public function setLocations(FieldGroupLocations $locations): self
    {
        $this->location = $locations->build();

        return $this;
    }

    public function build(): array
    {
        return json_decode(json_encode($this), true);
    }
}
