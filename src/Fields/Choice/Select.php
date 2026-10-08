<?php

namespace JorenRothman\ACFBuilder\Fields\Choice;

class Select extends ChoiceField
{
    public array $choices = [];

    public int $allow_null = 0;

    public int $multiple = 0;

    public int $ui = 0;

    public string $return_format = 'value';

    public int $ajax = 0;

    public string $placeholder = '';

    protected function setType(): void
    {
        $this->type = 'select';
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
     * Set the multiple state of the select
     *
     * @param bool $multiple
     * @return static
     */
    public function setMultiple(bool $multiple): static
    {
        $this->multiple = (int) $multiple;

        return $this;
    }

    /**
     * Set the ui state of the select
     *
     * @param bool $ui
     * @return static
     */
    public function setUi(bool $ui): static
    {
        $this->ui = (int) $ui;

        return $this;
    }

    /**
     * Set the return format of the select
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
     * Set the ajax state of the select
     *
     * @param bool $ajax
     * @return static
     */
    public function setAjax(bool $ajax): static
    {
        $this->ajax = (int) $ajax;

        return $this;
    }

    /**
     * Set the placeholder of the select
     *
     * @param string $placeholder
     * @return static
     */
    public function setPlaceholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
