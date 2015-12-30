<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

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
        $users = [];
	
        $password = 'letmein1';
        
	    for($i = 0; $i < 5; $i++) {

            $users[] = ['username'=>$this->faker->userName,

                        'email'=>$this->faker->email,

                        'password'=>bcrypt($password),

                        'active'=>true];
	    }

        foreach($users as $user) {

            $created = $this->userRepository->create($user);

            if( $created ) {
                $this->command->info(sprintf('Successfully created %s with email: %s', $user['username'], $user['email']));
            }
        }
    }
}
