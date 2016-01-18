<?php

namespace App\GardenRevolution\Repositories\Contracts;

/**
 * Interface CategoryRepositoryInterface
 *
 * @package App\GardenRevolution\Repositories\Contracts
 */
interface CategoryRepositoryInterface extends Crud, Collection
{
    /**
     * Should return collection of App\Models\Category of
     * categorizable_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantCategories();

    /**
     * Should return collection of App\Models\Category of
     * categorizable_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestCategories();

    /**
     * Should return collection of App\Models\Category of
     * categorizable_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureCategories();
}