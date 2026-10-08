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
     * @return static
     */
    public function setChoices(array $choices): static
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Set the allow custom state of the checkbox
     *
     * @param bool $allow_custom
     * @return static
     */
    public function setAllowCustom(bool $allow_custom): static
    {
        $this->allow_custom = (int) $allow_custom;

        return $this;
    }

    /**
     * Set the layout of the checkbox
     *
     * @param 'vertical'|'horizontal' $layout
     * @return static
     */
    public function setLayout(string $layout): static
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Set the toggle state of the checkbox
     *
     * @param bool $toggle
     * @return static
     */
    public function setToggle(bool $toggle): static
    {
        $this->toggle = (int) $toggle;

        return $this;
    }

    /**
     * Set the return format of the checkbox
     *
     * @param 'value'|'label'|'array' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Set the save custom state of the checkbox
     *
     * @param bool $save_custom
     * @return static
     */
    public function setSaveCustom(bool $save_custom): static
    {
        $this->save_custom = (int) $save_custom;

        return $this;
    }
}
