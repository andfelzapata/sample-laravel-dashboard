<?php

namespace App\GardenRevolution\Repositories;

use App\Models\Profile;

use App\GardenRevolution\Repositories\Contracts\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    /*
     * @var Profile model
     */
    private $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /*
     * @param array $data 
     * @return bool
     */
    public function create(array $data)
    {
        $this->profile = $this->profile->newInstance()->fill($data);
        return $this->profile->save();
    }

    /*
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id)
    {
        $this->profile = $this->profile->newInstance()->find($id);

        if( is_null($this->profile) ) 
        {
            return false;
        }

        $this->profile->fill($data);

        return $this->profile->save();
    }

    /*
     * @param $id
     * @param array $columns
     * @return $mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->profile = $this->profile->newInstance()->find($id,$columns);

        return $this->profile;
    }

    /*
     * @param $id
     * @return bool|null
     */
    public function delete($id)
    {
        $this->profile = $this->profile->newInstance()->find($id);

        if( is_null($this->profile) )
        {
            return false;
        }

        return $this->profile->delete();
    }
}
