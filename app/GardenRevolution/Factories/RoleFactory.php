<?php namespace App\GardenRevolution\Factories;

use App\Models\Roles\UserRole;
use App\Models\Roles\AdminRole;
use App\Models\Roles\PlantProviderRole;

class RoleFactory
{
    public function newAdminRoleInstance()
    {   
        $adminRole = new AdminRole();
        $adminRole->fill(array('name'=>'admin','display_name'=>'Admin'));
        return $adminRole;
    }

    public function newUserRoleInstance()
    {
        $userRole = new UserRole();
        $userRole->fill(array('name'=>'user','display_name'=>'User'));
        return $userRole;
    }

    public function newPlantProviderRoleInstance()
    {
        $plantProviderRole = new PlantProviderRole();
        $plantProviderRole->fill(array('name'=>'plant_provider','display_name'=>'Plant Provider'));
        return $plantProviderRole;
    }
}
