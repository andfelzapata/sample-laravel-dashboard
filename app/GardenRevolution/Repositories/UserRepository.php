<?php namespace App\GardenRevolution\Repositories;

use App\Models\User;

/*
 * Repository for users
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
class UserRepository extends Repository {

    public function __construct(User $user) {

        $this->model = $user;

    }

}
