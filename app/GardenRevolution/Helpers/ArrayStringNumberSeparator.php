<?php

namespace App\GardenRevolution\Helpers;

class ArrayStringNumberSeparator {

    private $numbers = [];

    private $strings = [];

    public function hasNewValue(Array $values)
    {
        foreach($values as $value){

            if(! is_numeric($value) )
            {
                return true;
                break;
            }

        }
    }

    public function separate(Array $values)
    {
        foreach ($values as $value) {

            if (is_numeric($value)) {
                array_push($this->numbers, $value);
            }

            else {
                array_push($this->strings, $value);
            }

        }

        return $this;
    }

    public function newInstance()
    {
        $this->numbers = [];
        $this->strings = [];

        return $this;
    }

    public function numbers()
    {
        return $this->numbers;
    }

    public function strings()
    {
        return $this->strings;
    }
}