<?php 

use Mockery as m;

use Faker\Factory;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class SettingsServiceTest extends TestCase
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

    public function testSettingsUpdateRequestSuccess()
    {
        $data = [
                    'user_id'=>$this->faker->numberBetween(1,21),
                    'receive_emails'=>$this->faker->boolean(),
                    'receive_text_alerts'=>$this->faker->boolean(),
                    'google_ical_alerts'=>$this->faker->boolean(),
                    'receive_push_alerts'=>$this->faker->boolean(),
                    'show_latin_names_plants'=>$this->faker->boolean(),
                    'show_latin_names_culinary_plants'=>$this->faker->boolean(),
                    'show_latin_names_pests'=>$this->faker->boolean()
                ];
        $this->post('/admin/dashboard/settings',$data)->seeJsonStructure([]);
    }
}
