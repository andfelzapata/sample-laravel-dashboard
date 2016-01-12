<?php namespace App\GardenRevolution\Repositories\Contracts;

use App\Models\Roles\Role;

/*
 * Interface for user repository.
 */
interface UserRepositoryInterface extends Crud, Collection 
{
    function createWithRole(array $data, Role $role);
}
