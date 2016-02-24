<?php 

namespace App\GardenRevolution\Repositories;

use App\Models\Settings;
use App\GardenRevolution\Repositories\Contracts\SettingsRepositoryInterface;

class SettingsRepository implements SettingsRepositoryInterface
{
    private $settings;

    public function __construct(Settings $setting)
    {
        $this->settings = $setting;
    }

    public function create(array $data)
    {
        $this->settings = $this->settings->newInstance()->create($data);
        return $this->settings;
    }

    public function update(array $data, $id)
    {
        $this->settings = $this->settings->newInstance()->find($id);

        if( is_null($this->settings) ) 
        {
            return false;
        }

        else 
        {
            $this->settings->fill($data);
            return $this->settings->save();
        }
    }

    public function delete($id)
    {
        $this->settings = $this->settings->newInstance()->find($id);

        if( is_null($this->settings) ) 
        {
            return false;
        }

        else 
        {
            return $this->settings->delete();
        }
    }

    public function find($id, $columns = array('*')) 
    {
        $this->settings = $this->settings->newInstance()->find($id,$columns);
        return $this->settings;
    }
}
