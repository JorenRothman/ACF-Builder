<?php

namespace Joren\ACFBuilder\Fields\Choice;

class ButtonGroup extends ChoiceField
{
    public array $choices = [];

    public bool $allow_null = false;

    public string $layout = 'horizontal';

    public string $return_format = 'value';

    public function setType(): void
    {
        $this->type = 'button_group';
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
     * Set the allow null state of the select
     *
     * @param bool $allow_null
     * @return self
     */
    public function setAllowNull(bool $allow_null): self
    {
        $this->allow_null = $allow_null;

        return $this;
    }

    /**
     * Set the layout of the select
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
}
