<?php namespace App\GardenRevolution\Repositories;

use App\Models\User;

use App\Models\Roles\Role;

use App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface;

/*
 * Repository for users
 */
class UserRepository implements UserRepositoryInterface {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }
    public function create(array $data) {
        $this->user = $this->user->newInstance()->fill($data);
        return $this->user->save();
    }
    
    public function update(array $data, $id) {
        $this->user = $this->user->newInstance()->find($id);;

        if( is_null($this->user) ) {
            return false;
        }

        else {
            $this->user->fill($data);
            return $this->user->save();
        }
    }

    public function delete($id) {
        $this->user = $this->user->newInstance()->find($id);;

        if( is_null($this->user) ) {
            return false;
        }

        else {
            return $this->user->delete();
        }
    }

    public function find($id, $columns = array('*')) {
        $this->user = $this->user->newInstance()->find($id,$columns);
        return $this->user;
    }
    
    public function createWithRole(array $data, Role $role) {
        $this->user = $this->user->newInstance()->fill($data);
        $saved = $this->user->save();

        if( $saved ) 
        {
            $this->user->attachRole($role);
        }

        return $saved;
    }

    public function getAll()
    {
        return Role::where('name','=','user')->first()->users;
    }

    public function getAllPaginated($pages = 10, Array $eagerLoads = [])
    {
        $users = Role::where('name','=','user')->first()->users()->paginate($pages);
        return $users;
    }
}
