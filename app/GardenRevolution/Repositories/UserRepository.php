<?php namespace App\GardenRevolution\Repositories;

/*
 * Repository for users
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
class UserRepository extends AbstractRepository {
    public function __construct(User $user) {
        $this->model = $user;
    }
}
