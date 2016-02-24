<?php namespace App\GardenRevolution\Forms;

use Validator;
use Lang;

abstract class Form 
{
    private $validator;
    protected $data;

    public function isValid(array $input) 
    {
        $this->data = $input;

        $this->validator = Validator::make($this->data,$this->getPreparedRules());

        return $this->validator->passes();
    }

    public function getErrors()
    {
        return $this->validator->errors();
    }

    abstract public function getPreparedRules();
}
