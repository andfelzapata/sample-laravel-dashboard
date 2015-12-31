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
        $errors = array_values($this->validator->errors()->toArray());

        $messages = array();
        
        //Anonymous class to avoid helpers
        $flatten = function($errors) use (&$flatten, &$messages) 
        {
            foreach( $errors as $error ) 
            {
                if( is_array($error) ) 
                {
                    $flatten($error);
                }

                else 
                {
                    $messages[] = $error;
                }
            }

        };

        $flatten($errors);

        return $messages;
    }

    abstract public function getPreparedRules();
}
