<?php

namespace App\GardenRevolution\Helpers;

class ArrayStringNumberSeparator {

    /**
     * Contains the numbers that represent existing id's in database.
     *
     * @var array
     */
    private $numbers = [];

    /**
     * Contains new values represented as strings, to be persisted in database.
     *
     * @var array
     */
    private $strings = [];

    /**
     * Check if array contains 'new values', but looking for non numeric
     * values.
     *
     * @param array $values
     * @return bool
     */
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

    /**
     * Separate existing id's from new values, 'strings'.
     *
     * @param array $values
     * @return $this
     */
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

    /**
     * @return $this
     */
    public function newInstance()
    {
        $this->numbers = [];
        $this->strings = [];

        return $this;
    }

    /**
     * Return separated numbers.
     *
     * @return array
     */
    public function numbers()
    {
        return $this->numbers;
    }

    /**
     * Return separated strings, which represent new values.
     *
     * @return array
     */
    public function strings()
    {
        return $this->strings;
    }
}