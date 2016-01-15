<?php

namespace App\GardenRevolution\Repositories;

use DB;

use App\Models\State;

use App\GardenRevolution\Repositories\Contracts\StateRepositoryInterface;

class StateRepository implements StateRepositoryInterface
{
    private $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function getAll()
    {
        try 
        {
            return DB::table('states')->lists('name','abbreviation');
        }

        catch(Exception $ex)
        {
            return [];
        }
    }

    public function getAllPaginated($pages,array $eagerloads)
    {

    }
}
