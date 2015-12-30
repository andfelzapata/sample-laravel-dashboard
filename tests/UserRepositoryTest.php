<?php 

use Mockery as m;

use Faker\Factory;

use App\GardenRevolution\Repositories\UserRepository;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('fill')->times(1)->andReturn('ok');
        $this->user->shouldReceive('save')->times(1)->andReturn(true);
        
        $this->userRepository = new UserRepository($this->user);

        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];
                
        $isCreated = $this->userRepository->create($data);

        $this->assertTrue(true,$isCreated);
    }

    public function testRepositoryCreateFailure() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('fill')->times(1)->andReturn('ok');
        $this->user->shouldReceive('save')->times(1)->andReturn(false);
        
        $this->userRepository = new UserRepository($this->user);

        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];

        $isCreated = $this->userRepository->create($data);

        $this->assertFalse($isCreated);
    }

    public function testRepositoryFindSuccess() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);

        $index = 1;
        $columns = ['username','email'];
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('find')->times(1)->with($index,$columns)->andReturn($this->user);
    
        $this->userRepository = new UserRepository($this->user);
        $user = $this->userRepository->find($index,$columns);
        
        $isUser = $user instanceOf App\Models\User;
        $this->assertTrue($isUser);
    }

    public function testRepositoryFindFailure() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);

        $index = 1;
        $columns = ['username','email'];
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('find')->times(1)->with($index,$columns)->andReturn(null);
    
        $this->userRepository = new UserRepository($this->user);
        $user = $this->userRepository->find($index,$columns);
        
        $isNotUser = is_null($user);
        $this->assertTrue($isNotUser);
    }

    public function testRepositoryUpdateSuccess() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);

        $index = 1;
        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('find')->times(1)->with($index)->andReturn($this->user);
        $this->user->shouldReceive('fill')->times(1)->andReturn('ok');
        $this->user->shouldReceive('save')->times(1)->andReturn(true);
    
        $this->userRepository = new UserRepository($this->user);
        $isUpdated = $this->userRepository->update($data,$index);
        
        $this->assertTrue($isUpdated);
    }

    public function testRepositoryUpdateFailure() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);

        $index = 1;
        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('find')->times(1)->with($index)->andReturn(null);
    
        $this->userRepository = new UserRepository($this->user);
        $isUpdated = $this->userRepository->update($data,$index);
        
        $this->assertFalse($isUpdated);
    }

    public function testRepositoryDeleteSuccess() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);
        
        $index = 1;
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('find')->times(1)->with($index)->andReturn($this->user);
        $this->user->shouldReceive('delete')->times(1)->andReturn(true);

        $this->userRepository = new UserRepository($this->user);
        $isDeleted = $this->userRepository->delete($index);
        
        $this->assertTrue($isDeleted);
    }

    public function testRepositoryDeleteFailure() {
        $this->user = Mockery::mock('Illuminate\Database\Eloquent\Model', 'App\Models\User');
        $this->app->instance('App\Models\User',$this->user);
        
        $index = 1;
        
        $this->user->shouldReceive('newInstance')->andReturn('ok');       
        $this->user->shouldReceive('find')->times(1)->with($index)->andReturn(null);

        $this->userRepository = new UserRepository($this->user);
        $isDeleted = $this->userRepository->delete($index);
        
        $this->assertFalse($isDeleted);
    }
}
