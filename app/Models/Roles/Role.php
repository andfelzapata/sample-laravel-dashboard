<?php namespace App\Models\Roles;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];
    
    /*
     * Make sure to use Role::where('name','=',ROLE_TYPE) in conjunction with
     * relation below.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
