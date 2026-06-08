<?php

use JorenRothman\ACFBuilder\Fields\JQuery\DatePicker;
use JorenRothman\ACFBuilder\Fields\JQuery\DateTimePicker;
use PHPUnit\Framework\TestCase;

final class DatePickerTest extends TestCase
{
    public function testSetFirstDayValidDay()
    {
        $picker = new DatePicker('Date');
        $picker->setFirstDay('sunday');

        $this->assertEquals(0, $picker->first_day);
    }

    public function testSetFirstDayAllDays()
    {
        $days = ['sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6];

        foreach ($days as $day => $expected) {
            $picker = new DatePicker('Date');
            $picker->setFirstDay($day);
            $this->assertEquals($expected, $picker->first_day, "Failed for day: {$day}");
        }
    }

    public function testSetFirstDayInvalidThrows()
    {
        $picker = new DatePicker('Date');

        $this->expectException(\InvalidArgumentException::class);
        $picker->setFirstDay('funday');
    }

    public function testDateTimePickerSharesFirstDayBehavior()
    {
        $picker = new DateTimePicker('Date Time');
        $picker->setFirstDay('friday');

        $this->assertEquals(5, $picker->first_day);
    }

    public function testDefaultFormats()
    {
        $date     = new DatePicker('Date');
        $dateTime = new DateTimePicker('Date Time');

        $this->assertEquals('d/m/Y', $date->display_format);
        $this->assertEquals('d/m/Y', $date->return_format);
        $this->assertEquals('d/m/Y g:i a', $dateTime->display_format);
        $this->assertEquals('d/m/Y g:i a', $dateTime->return_format);
    }

    public function testSetDisplayFormat()
    {
        $picker = new DatePicker('Date');
        $picker->setDisplayFormat('Y-m-d');

        $this->assertEquals('Y-m-d', $picker->display_format);
    }
}
