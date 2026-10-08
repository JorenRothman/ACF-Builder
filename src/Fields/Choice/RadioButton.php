<?php

namespace JorenRothman\ACFBuilder\Fields\Choice;

class RadioButton extends ChoiceField
{
    public array $choices = [];

    public int $allow_null = 0;

    public int $other_choice = 0;

    public string $layout = 'vertical';

    public string $return_format = 'value';

    public int $save_other_choice = 0;

    public function setType(): void
    {
        $this->type = 'radio';
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
     * Set the allow null state of the select
     *
     * @param bool $allow_null
     * @return static
     */
    public function setAllowNull(bool $allow_null): static
    {
        $this->allow_null = (int) $allow_null;

        return $this;
    }

    /**
     * Set the other choice state of the select
     *
     * @param bool $other_choice
     * @return static
     */
    public function setOtherChoice(bool $other_choice): static
    {
        $this->other_choice = (int) $other_choice;

        return $this;
    }

    /**
     * Set the layout of the select
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
     * Set the return format of the select
     *
     * @param 'value'|'label' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Set the save other choice state of the select
     *
     * @param bool $save_other_choice
     * @return static
     */
    public function setSaveOtherChoice(bool $save_other_choice): static
    {
        $this->save_other_choice = (int) $save_other_choice;

        return $this;
    }
}
