<?php

namespace Joren\ACFBuilder\Fields\Choice;

class Checkbox extends ChoiceField
{
    public array $choices = [];

    public bool $allow_custom = false;

    public string $layout = 'vertical';

    public bool $toggle = false;

    public bool $return_format = 'value';

    public bool $save_custom = false;

    public function setType(): void
    {
        $this->type = 'checkbox';
    }

    /**
     * Set array of choices where the key is used as value and the value is used as label
     *
     * @param array $choices
     * @return self
     */
    public function setChoices(array $choices): self
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Set the allow custom state of the checkbox
     *
     * @param bool $allow_custom
     * @return self
     */
    public function setAllowCustom(bool $allow_custom): self
    {
        $this->allow_custom = $allow_custom;

        return $this;
    }

    /**
     * Set the layout of the checkbox
     * options: vertical, horizontal
     *
     * @param string $layout
     * @return self
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Set the toggle state of the checkbox
     *
     * @param bool $toggle
     * @return self
     */
    public function setToggle(bool $toggle): self
    {
        $this->toggle = $toggle;

        return $this;
    }

    /**
     * Set the return format of the checkbox
     *
     * @param bool $return_format
     * @return self
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Set the save custom state of the checkbox
     *
     * @param bool $save_custom
     * @return self
     */
    public function setSaveCustom(bool $save_custom): self
    {
        $this->save_custom = $save_custom;

        return $this;
    }
}
