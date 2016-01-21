<?php namespace App\GardenRevolution\Forms\Settings;

/*
 * Form to validate storing a settings.
 */

use App\GardenRevolution\Forms\Form;

class StoreSettingsForm extends Form 
{
    public function getPreparedRules() 
    {
        return [
                'user_id'=>'required|exists:users,id',
                'receive_emails'=>'sometimes|boolean',
                'receive_text_alerts'=>'sometimes|boolean',
                'google_ical_alerts'=>'sometimes|boolean',
                'receive_push_alerts'=>'sometimes|boolean',
                'show_latin_names_plants'=>'sometimes|boolean',
                'show_latin_names_culinary_plants'=>'sometimes|boolean',
                'show_latin_names_pests'=>'sometimes|boolean'
               ];        
    }
}
