<?php

use Illuminate\Database\Seeder;
use App\GardenRevolution\Factories\RoleFactory;

class RoleTableSeeder extends Seeder
{
    public function __construct(RoleFactory $roleFactory) 
    {
        $this->roleFactory = $roleFactory;
    }

    public function run()
    {
        $this->roleFactory->newAdminRoleInstance()->save();
        $this->roleFactory->newUserRoleInstance()->save();
        $this->roleFactory->newPlantProviderRoleInstance()->save();
    }
}
