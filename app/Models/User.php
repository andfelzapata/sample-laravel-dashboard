<?php

namespace App\Models;

use DB;

use Laravel\Cashier\Billable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Billable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username', 'password','active'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /*
     * Return the profile associated with this user.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    
    /*
     * Return the settings associated with this user.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function settings()
    {
        return $this->hasOne('App\Models\Settings');
    }
 
    /*
     * Return the payments associated with this user.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    /* NOT A RELATIONSHIP METHOD, PAY ATTENTION TO CODE
     * Return the transactions associated with this user.
     */
    public function transactions()
    {
        $payments = DB::table('payments')->where('user_id',$this->id)->select('name','id')->get();

        $paymentIds = array();
        $paymentNames = array();

        foreach($payments as $payment) {
            $paymentIds[] = $payment->id;
            $paymentNames[$payment->id] = $payment->name;
        }

        $transactions = DB::table('transactions')->whereIn('payment_id',$paymentIds)->get();

        foreach($transactions as $transaction) {
            $transaction->method = $paymentNames[$transaction->payment_id];
        }

        return $transactions;
    }


    /**
     * Check separately to see if account is active.
     *
     * @param  String $username
     *
     * @return Bool
     */
    public static function accountActive($username)
    {
        $active = User::where('active', True)

            ->where('username', $username)

            ->first();

        return ($active != null) ? true: false;

    }

    /**
     * Check if username exists.
     *
     * @param  String $username
     *
     * @return Bool
     */
    public static function usernameExists($username)
    {
        $exists = User::where('username', $username)

            ->first();

        return ($exists != null) ? True: False;

    }

}
