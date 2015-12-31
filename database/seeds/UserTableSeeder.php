<?php

use Faker\Factory;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\GardenRevolution\Repositories\UserRepository;

class UserTableSeeder extends Seeder
{
    public function __construct(UserRepository $userRepository) {

        $this->userRepository = $userRepository;

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

        $password = 'letmein1';

        $users[] = ['username' => 'admin',

                    'name' => 'Tim Baio',

                    'email'=> 'email@sample.com',

                    'password'=> bcrypt('1q2w3e4r'),

                    'active'=> true ];
        
	    for($i = 0; $i < 20; $i++) {

            $users[] = ['username' => $this->faker->userName,

                        'name' => $this->faker->name,

                        'email' => $this->faker->email,

                        'password' => bcrypt($password),

                        'active' => true];
	    }

        foreach($users as $user) {

            $created = $this->userRepository->create($user);

            if( $created ) {

                $this->command->info(sprintf('Successfully created %s with email: %s', $user['username'], $user['email']));

            }
        }
    }
}
