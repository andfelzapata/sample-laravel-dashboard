<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {

    /*
     * The table associated with the model.
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','receive_emails','receive_text_alerts','google_ical_alerts','receive_push_alerts','show_latin_names_plants','show_latin_names_culinary_plants','show_latin_names_pests'
    ];
}
