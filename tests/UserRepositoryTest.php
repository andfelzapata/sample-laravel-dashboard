<?php 

use Mockery as m;
use Faker\Factory;
use App\GardenRevolution\Repositories\UserRepository;

class UserRepositoryTest extends TestCase {
    public function setUp() {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }

    public function tearDown() {
        parent::tearDown();
        m::close();
    }

    public function testRepositoryCreate() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);

        $this->user->shouldReceive('fill')->times(1)->andReturn('ok');
        $this->user->shouldReceive('save')->times(1)->andReturn(true);
        
        
        $this->userRepository = new UserRepository($this->user);

        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];
                

        $isCreated = $this->userRepository->create($data);

        $this->assertEquals(true,$isCreated);
    }
}
