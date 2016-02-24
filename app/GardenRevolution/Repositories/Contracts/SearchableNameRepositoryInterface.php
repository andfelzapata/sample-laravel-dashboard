<?php

namespace App\GardenRevolution\Repositories\Contracts;

interface SearchableNameRepositoryInterface extends CRUD, Collection
{
    /**
     * Should return collection of App\Models\SearchableName of
     * searchable_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantSearchableNames();

    /**
     * Should return collection of App\Models\SearchableName of
     * searchable_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestSearchableNames();

    /**
     * Should return collection of App\Models\SearchableName of
     * searchable_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureSearchableNames();
}