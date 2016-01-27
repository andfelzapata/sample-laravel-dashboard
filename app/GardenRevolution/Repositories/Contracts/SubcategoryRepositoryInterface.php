<?php

namespace App\GardenRevolution\Repositories\Contracts;

/**
 * Interface SubcategoryRepositoryInterface
 *
 * @package App\GardenRevolution\Repositories\Contracts
 */
interface SubcategoryRepositoryInterface extends Crud, Collection
{
    /**
     * Return Collection of App\Models\Category
     * of subcategory_type App\Models\Plant.
     *
     * @return mixed
     */
    public function getPlantSubcategories();

    /**
     * Return Collection of App\Models\Category
     * of subcategory_type App\Models\Pest.
     *
     * @return mixed
     */
    public function getPestSubcategories();

    /**
     * Return Collection of App\Models\Category
     * of subcategory_type App\Models\Procedure.
     *
     * @return mixed
     */
    public function getProcedureSubcategories();
}