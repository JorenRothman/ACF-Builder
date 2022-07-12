<?php

namespace Joren\ACFBuilder\Fields\JQuery;

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
     * @return self 
     */
    public function setDefaultValue(string $default_value): self
    {
        $this->default_value = $default_value;

        return $this;
    }

    /**
     * Set the enable opacity.
     * 
     * @param bool $enable_opacity 
     * @return self 
     */
    public function setEnableOpacity(bool $enable_opacity): self
    {
        $this->enable_opacity = $enable_opacity;

        return $this;
    }

    /**
     * Set the return format.
     * options: string, array
     * 
     * @param string $return_format 
     * @return self 
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }
}
