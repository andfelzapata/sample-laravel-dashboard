<?php 

use Mockery as m;

use Faker\Factory;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProfileServiceTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp() {
        parent::setUp();
        $this->faker = Faker\Factory::create();
        $this->payloadFactory = new PayloadFactory;
    }

    public function tearDown() {
        parent::tearDown();
        m::close();
    }

    public function testServiceStoreSuccess()
    {
        $profileService = m::mock('App\GardenRevolution\Service\ProfileService');
        $this->app->instance('App\GardenRevolution\Service\ProfileService',$profileService);

        $payload = $this->payloadFactory->newInstance();
        $payload->setStatus(PayloadStatus::CREATED);

        $data = [
                    'first_name'=>$this->faker->firstName,
                    'last_name'=>$this->faker->lastName,
                    'city'=>$this->faker->city,
                    'street_address'=>$this->faker->streetAddress,
                    'state'=>$this->faker->stateAbbr,
                    'zip'=>$this->faker->postcode,
                    'apt_suite'=>$this->faker->buildingNumber
                ];
        
        $profileService->shouldReceive('store')->with($data)->times(1)->andReturn($payload);

        $result = $profileService->store($data);

        $this->assertEquals($result->getStatus(),PayloadStatus::CREATED);
    }

    public function testServiceStoreRequestSuccess()
    {
        $data = [
                    'first_name'=>$this->faker->firstName,
                    'last_name'=>$this->faker->lastName,
                    'city'=>$this->faker->city,
                    'street_address'=>$this->faker->streetAddress,
                    'state'=>$this->faker->stateAbbr,
                    'zip'=>$this->faker->randomNumber(5),
                    'apt_suite'=>$this->faker->buildingNumber,
                    'user_id'=>$this->faker->numberBetween(1,20)
                ];

        $this->post('/admin/dashboard/profiles',$data)->seeJsonStructure(['profile_id']);
    }
}
