<?php

namespace App\GardenRevolution\Forms\Categories;

/*
 * Class to return forms regarding plant request validation.
 */

class CategoryFormFactory
{
    public function newGetCategoryFormInstance()
    {
        return new GetCategoryForm();
    }

    public function newUpdateCategoryFormInstance()
    {
        return new UpdateCategoryForm();
    }

    public function newStoreCategoryFormInstance()
    {
        return new StoreCategoryForm();
    }

    public function newDeleteCategoryFormInstance()
    {
        return new DeleteCategoryForm();
    }
}
