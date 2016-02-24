<?php namespace App\GardenRevolution\Repositories\Contracts;

interface Collection
{
    function getAll();

    /**
     * @param $pages Number of pages for pagination.
     * @param $eagerLoads Array containing models to eager load.
     * @return mixed
     */
    function getAllPaginated($pages, Array $eagerLoads);
}
