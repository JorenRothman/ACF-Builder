<?php

namespace Joren\ACFBuilder\Fields\JQuery;

class TimePicker extends JQueryField
{
    public string $display_format = 'g:i a';

    public string $return_format = 'g:i a';

    public function setType(): void
    {
        $this->type = 'date_picker';
    }

    /**
     * Set the display format.
     * 
     * @param string $display_format 
     * @return self 
     */
    public function setDisplayFormat(string $display_format): self
    {
        $this->display_format = $display_format;

        return $this;
    }

    /**
     * Set the return format.
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
