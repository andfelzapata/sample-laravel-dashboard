<?php

namespace App\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
