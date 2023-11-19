<?php

namespace JorenRothman\ACFBuilder\Fields\Choice;

class Checkbox extends ChoiceField
{
    public array $choices = [];

    public int $allow_custom = 0;

    public string $layout = 'vertical';

    public int $toggle = 0;

    public string $return_format = 'value';

    public int $save_custom = 0;

    public mixed $default_value = [];

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
        $this->allow_custom = (int) $allow_custom;

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
        $this->toggle = (int) $toggle;

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
        $this->save_custom = (int) $save_custom;

        return $this;
    }
}
