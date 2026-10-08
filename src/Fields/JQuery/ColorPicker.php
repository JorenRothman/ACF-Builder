<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

class ColorPicker extends JQueryField
{
    public string $default_value = '';

    public bool $enable_opacity = false;

    public string $return_format = 'string';

    public function setType(): void
    {
        $this->type = 'color_picker';
    }

    /**
     * Set the default value.
     * 
     * @param string $default_value 
     * @return static 
     */
    public function setDefaultValue(string $default_value): static
    {
        $this->default_value = $default_value;

        return $this;
    }

    /**
     * Set the enable opacity.
     * 
     * @param bool $enable_opacity 
     * @return static 
     */
    public function setEnableOpacity(bool $enable_opacity): static
    {
        $this->enable_opacity = $enable_opacity;

        return $this;
    }

    /**
     * Set the return format.
     *
     * @param 'string'|'array' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }
}
