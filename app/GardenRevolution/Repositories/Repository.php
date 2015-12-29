<?php namespace App\GardenRevolution\Repositories;

use Illuminate\Database\Eloquent\Model;

use App\GardenRevolution\Repositories\Contracts\Crud;
use App\GardenRevolution\Repositories\Exceptions\NotModelInstance;

/*
 * Base class for Repositories.
 * @author Alan Ruvalcaba
 * @since 2015-12-28
 */
abstract class Repository implements Crud {
    public function __construct(Model $model) {
        $this->$model = $model;
    }
    
    public function create(array $data) {
        $this->model->fill($data);
        return $this->model->save();
    }
    
    public function update(array $data, $id) {
        $this->model = $this->model->find($id);

        if( is_null($this->model) ) {
            return false;
        }

        else {
            $this->model->fill($data);
            return $this->model->save();
        }
    }

    public function delete($id) {
        $this->model = $this->model->find($id);

        if( is_null($this->model) ) {
            return false;
        }

        else {
            return $this->model->delete();
        }
    }

    public function find($id, $columns = array('*')) {
        return $this->model->find($id,$columns);
    }
}
