<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

class TimePicker extends JQueryField
{
    public string $display_format = 'g:i a';

    public string $return_format = 'g:i a';

    public function setType(): void
    {
        $this->type = 'time_picker';
    }

    /**
     * Set the display format.
     *
     * @param string $display_format
     * @return static
     */
    public function setDisplayFormat(string $display_format): static
    {
        $this->display_format = $display_format;

        return $this;
    }

    /**
     * Set the return format.
     *
     * @param string $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }
}
