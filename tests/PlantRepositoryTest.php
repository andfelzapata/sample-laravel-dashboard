<?php

use Faker\Factory;

class PlantRepositoryTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function tearDown() {
        parent::tearDown();
        Mockery::close();
    }

    public function testRepositoryCreateSuccess() {
        $plantRepository = Mockery::mock('App\GardenRevolution\Repositories\Contracts\PLantRepositoryInterface');
        $this->app->instance('App\GardenRevolution\Repositories\PlantRepositoryInterface', $plantRepository);

        $data = ['username'=> $this->faker->userName, 'email'=> $this->faker->email, 'password'=>$this->faker->password];

        $plantRepository->shouldReceive('create')->times(1)->andReturn(true);

        $isCreated = $plantRepository->create($data);

        $this->assertTrue($isCreated);
    }
}
