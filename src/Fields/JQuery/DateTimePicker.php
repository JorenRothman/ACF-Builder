<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

class DateTimePicker extends DateField
{
    public string $display_format = 'd/m/Y g:i a';

    public string $return_format = 'd/m/Y g:i a';

    public function setType(): void
    {
        $this->type = 'date_time_picker';
    }
}
