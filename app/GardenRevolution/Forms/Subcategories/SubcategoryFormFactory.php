<?php namespace App\GardenRevolution\Forms\Subcategories;

/*
 * Class to return forms regarding plant request validation.
 */

class SubcategoryFormFactory
{
    public function newGetSubcategoryFormInstance()
    {
        return new GetSubcategoryForm();
    }

    public function newUpdateSubcategoryFormInstance()
    {
        return new UpdateSubcategoryForm();
    }

    public function newStoreSubcategoryFormInstance()
    {
        return new StoreSubcategoryForm();
    }

    public function newDeleteSubcategoryFormInstance()
    {
        return new DeleteSubcategoryForm();
    }
}
