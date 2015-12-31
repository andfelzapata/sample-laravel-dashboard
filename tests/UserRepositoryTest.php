<?php 

use Mockery as m;

use Faker\Factory;

class UserRepositoryTest extends TestCase {
    public function setUp() {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }

    public function tearDown() {
        parent::tearDown();
        m::close();
    }

    public function testRepositoryCreateSuccess() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\UserRepositoryInterface',$userRepository);

        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];

        $userRepository->shouldReceive('create')->times(1)->andReturn(true);        

        $isCreated = $userRepository->create($data);

        $this->assertTrue($isCreated);
    }

    public function testRepositoryCreateFailure() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);

        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];
        
        $userRepository->shouldReceive('create')->times(1)->andReturn(false);        

        $isCreated = $userRepository->create($data);

        $this->assertFalse($isCreated);
    }

    public function testRepositoryFindSuccess() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);
        
        $index = 1;
        $columns = ['username','email'];
        
        $user = m::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$user);
        
        $userRepository->shouldReceive('find')->with($index,$columns)->andReturn($user);

        $user = $userRepository->find($index,$columns);
        
        $isUser = $user instanceOf App\Models\User;
        $this->assertTrue($isUser);
    }

    public function testRepositoryFindFailure() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);

        $index = 1;
        $columns = ['username','email'];
        
        $userRepository->shouldReceive('find')->with($index,$columns)->andReturn(null);
        
        $user = $userRepository->find($index,$columns);
        
        $isNotUser = is_null($user);
        $this->assertTrue($isNotUser);
    }

    public function testRepositoryUpdateSuccess() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);

        $index = 1;
        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];

        $userRepository->shouldReceive('update')->with($data,$index)->andReturn(true);

        $isUpdated = $userRepository->update($data,$index);
        
        $this->assertTrue($isUpdated);
    }

    public function testRepositoryUpdateFailure() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);

        $index = 1;
        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];

        $userRepository->shouldReceive('update')->with($data,$index)->andReturn(false);

        $isUpdated = $userRepository->update($data,$index);

        $this->assertFalse($isUpdated);
    }

    public function testRepositoryDeleteSuccess() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);

        $index = 1;

        $userRepository->shouldReceive('delete')->with($index)->andReturn(true);

        $isDeleted = $userRepository->delete($index);
        
        $this->assertTrue($isDeleted);
    }

    public function testRepositoryDeleteFailure() {
        $userRepository = m::mock('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\Contracts\UserRepositoryInterface',$userRepository);

        $index = 1;

        $userRepository->shouldReceive('delete')->with($index)->andReturn(false);

        $isDeleted = $userRepository->delete($index);
        
        $this->assertFalse($isDeleted);
    }
}
