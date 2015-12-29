<?php namespace App\GardenRevolution\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\GardenRevolution\Repositories\Contracts\Crud;
use App\GardenRevolution\Repositories\Exceptions\NotModelInstance;

/*a
 * Base class for Repositories.
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
abstract class Repository implements Crud {
    protected $model;
    
    public function __construct() {
        $this->$model = $this->model();

        if( ! ( $this->model instanceOf Model ) ) {
            throw new NotModelInstance();                  
        }
    }

    /*
     * Specify Model class by returning a class with Eloquent Model as base
     * class.
     */
    abstract function model();
}
