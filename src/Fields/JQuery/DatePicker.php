<?php

namespace Joren\ACFBuilder\Fields\JQuery;

class DatePicker extends JQueryField
{
    public string $display_format = 'd/m/Y';

    public string $return_format = 'd/m/Y';

    public int $first_day = 1;

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

    /**
     * Set the first day.
     * 
     * @param string $first_day 
     * @return self 
     */
    public function setFirstDay(string $first_day): self
    {
        $this->first_day = $this->searchDay($first_day);

        return $this;
    }
}
