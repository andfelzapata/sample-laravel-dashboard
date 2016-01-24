<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_id','user_id','name','exp_year','exp_month','last4'
    ];

    public function getCardNumberAttribute($value) {
        $cardNumber = '';

        for($i = 0; $i < 16; $i++) {
            $cardNumber .= '&#x2022;';
        }

        $cardNumber .= $this->last4;

        return $cardNumber;
    }
}
