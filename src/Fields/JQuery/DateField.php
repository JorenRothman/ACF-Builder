<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

abstract class DateField extends JQueryField
{
    public string $display_format;

    public string $return_format;

    public int $first_day = 1;

    public function setDisplayFormat(string $display_format): static
    {
        $this->display_format = $display_format;

        return $this;
    }

    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * @param 'sunday'|'monday'|'tuesday'|'wednesday'|'thursday'|'friday'|'saturday' $first_day
     */
    public function setFirstDay(string $first_day): static
    {
        $this->first_day = $this->searchDay($first_day);

        return $this;
    }
}
