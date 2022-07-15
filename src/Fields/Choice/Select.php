<?php

namespace Joren\ACFBuilder\Fields\Choice;

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
        $this->allow_null = (int) $allow_null;

        return $this;
    }

    /**
     * Set the multiple state of the select
     *
     * @param bool $multiple
     * @return self
     */
    public function setMultiple(bool $multiple): self
    {
        $this->multiple = (int) $multiple;

        return $this;
    }

    /**
     * Set the ui state of the select
     *
     * @param bool $ui
     * @return self
     */
    public function setUi(bool $ui): self
    {
        $this->ui = (int) $ui;

        return $this;
    }

    /**
     * Set the return format of the select
     *
     * @param string $return_format
     * @return self
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Set the ajax state of the select
     *
     * @param bool $ajax
     * @return self
     */
    public function setAjax(bool $ajax): self
    {
        $this->ajax = (int) $ajax;

        return $this;
    }

    /**
     * Set the placeholder of the select
     *
     * @param string $placeholder
     * @return self
     */
    public function setPlaceholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }
}
