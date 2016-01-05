<?php namespace App\GardenRevolution\Repositories\Contracts;

use App\Models\Roles\Role;

/*
 * Interface for user repository.
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
interface UserRepositoryInterface extends Crud, Collection 
{
    function createWithRole(array $data, Role $role);
}
