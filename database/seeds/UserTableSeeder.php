<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\Models\User;

use App\Models\Roles\Role;

use App\GardenRevolution\Repositories\UserRepository;
use App\GardenRevolution\Repositories\ProfileRepository;

class UserTableSeeder extends Seeder
{
    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository) {

        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;

        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        User::truncate();

        $users = [];
        $profiles = [];

        $password = 'letmein1';
        
        $admin = [
                    'username' => 'admin',

                    'email'=> 'email@sample.com',

                    'password'=> bcrypt('1q2w3e4r'),

                    'active'=> true ];
        $adminProfile = [
                    'first_name'=>$this->faker->firstName,
                    'last_name'=>$this->faker->lastName,
                    'city'=>$this->faker->city,
                    'street_address'=>$this->faker->streetAddress,
                    'state'=>$this->faker->stateAbbr,
                    'zip'=>$this->faker->randomNumber(5),
                    'apt_suite'=>$this->faker->buildingNumber,
                    'user_id'=>$this->faker->numberBetween(1,20)
                ];

        $adminRole = Role::where('name','=','admin')->firstOrFail();
        $userRole = Role::where('name','=','user')->firstOrFail();

        $admin = $this->userRepository->createWithRole($admin,$adminRole);
        $adminProfile = $this->profileRepository->create($adminProfile);

        if( $admin->id && $adminProfile->id) 
        {
            $admin->profile()->save($adminProfile);

            $this->command->info(sprintf('Successfully created %s with email: %s with %s role', $admin['username'], $admin['email'],$adminRole->display_name));

        }
        
        for($i = 0; $i < 20; $i++) 
        {

            $users[] = ['username' => $this->faker->userName,

                        'email' => $this->faker->email,

                        'password' => bcrypt($password),

                        'active' => true];
            $profiles[] = [
                            'first_name'=>$this->faker->firstName,
                            'last_name'=>$this->faker->lastName,
                            'city'=>$this->faker->city,
                            'street_address'=>$this->faker->streetAddress,
                            'state'=>$this->faker->stateAbbr,
                            'zip'=>$this->faker->randomNumber(5),
                            'apt_suite'=>$this->faker->buildingNumber,
                            'user_id'=>$this->faker->numberBetween(1,20)
                            ];
	    }

        for($i = 0; $i < 20; $i++) 
        {
            $user = $this->userRepository->createWithRole($users[$i],$userRole);
            $profile = $this->profileRepository->create($profiles[$i]);

            if( $user->id && $profile->id ) 
            {
                $user->profile()->save($profile);
                $this->command->info(sprintf('Successfully created %s with email: %s with %s role', $user[$i]['username'], $user[$i]['email'],$userRole->display_name));

            }
        }
    }
}
