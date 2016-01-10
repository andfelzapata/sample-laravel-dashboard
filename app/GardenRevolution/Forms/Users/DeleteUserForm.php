<?php namespace App\GardenRevolution\Forms\Users;

/*
 * @author Alan Ruvalcaba
 * @since 01-09-2016
 * Form to validate user delete.
 */

use App\GardenRevolution\Forms\Form;

class DeleteUserForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'id'=>'required|numeric|exists:users,id'
               ];        
    }
}
