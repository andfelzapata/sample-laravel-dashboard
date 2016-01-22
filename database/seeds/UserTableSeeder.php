<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\Models\User;

use App\Models\Roles\Role;

use App\GardenRevolution\Repositories\UserRepository;
use App\GardenRevolution\Repositories\ProfileRepository;
use App\GardenRevolution\Repositories\SettingsRepository;

class UserTableSeeder extends Seeder
{
    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository, SettingsRepository $settingsRepository) {

        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
        $this->settingsRepository = $settingsRepository;

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
        $settings = [];

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

        $stripeIds = [
            'cus_7lMNKeylRMwqpW',
            'cus_7lMNLjSQsj4K24',
            'cus_7lMSyQPsTskKGG',
            'cus_7lNXVVN2f32UGB',
            'cus_7lNX4Y64SVnc5d',
            'cus_7lNXcSC90lzLea',
            'cus_7lNauEoYyyFChu',
            'cus_7lNa3pGBxze9xt',
            'cus_7lNanvEmFgRVPc',
            'cus_7lNa2w94Rkruj5',
            'cus_7lNaP627V1B4US',
            'cus_7lNaigSYfBuusM',
            'cus_7lNbfSB9pZG5vK',
            'cus_7lNb2BqCkjoCKS',
            'cus_7lfwvAen7A1CfB',
            'cus_7lfx8EHJytk9hn',
            'cus_7lfxVg4x1s3SXU',
            'cus_7lfyTuo9msT2AX',
            'cus_7lfyQd3jgoZJly',
            'cus_7lfz9kziWibm6D',
            'cus_7lfzIsVXKsdoFM'
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
        
        for($i = 0; $i < 21; $i++) 
        {

            $index = $i + 1;

            $users[] = ['username' => $this->faker->userName,

                        'email' => sprintf('user%d@gr.com',$index),

                        'password' => bcrypt($password),

                        'stripe_id' => $stripeIds[$i],

                        'active' => true];
            $profiles[] = [
                            'first_name'=>$this->faker->firstName,
                            'last_name'=>$this->faker->lastName,
                            'city'=>$this->faker->city,
                            'street_address'=>$this->faker->streetAddress,
                            'state'=>$this->faker->stateAbbr,
                            'zip'=>$this->faker->randomNumber(5),
                            'apt_suite'=>$this->faker->buildingNumber,
                            'user_id'=>$index
                        ];
            $settings[] = [
                            'user_id'=>$index,
                            'receive_emails'=>$this->faker->boolean(),
                            'receive_text_alerts'=>$this->faker->boolean(),
                            'google_ical_alerts'=>$this->faker->boolean(),
                            'receive_push_alerts'=>$this->faker->boolean(),
                            'show_latin_names_plants'=>$this->faker->boolean(),
                            'show_latin_names_culinary_plants'=>$this->faker->boolean(),
                            'show_latin_names_pests'=>$this->faker->boolean()
                          ];
	    }

        for($i = 0; $i < 21; $i++) 
        {
            $user = $this->userRepository->createWithRole($users[$i],$userRole);
            $profile = $this->profileRepository->create($profiles[$i]);
            $setting = $this->settingsRepository->create($settings[$i]);

            if( $user->id && $profile->id && $setting->id ) 
            {
                $user->profile()->save($profile);
                $user->settings()->save($setting);
                $this->command->info(sprintf('Successfully created %s with email: %s with %s role', $user->username, $user->email,$userRole->display_name));
            }
        }
    }
}
