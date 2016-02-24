<?php 

use Mockery as m;

use App\GardenRevolution\Helpers\ReflectionHelper;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class ReflectionHelperTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp() {
        parent::setUp();
    }

    public function tearDown() {
        parent::tearDown();
        m::close();
    }

    /**
     * @expectedException Exception
     */
    public function testShortNameWithPrimitive()
    {
        $object = 1;
        
        ReflectionHelper::getShortName($object);
    }
    
    /**
     * @expectedException Exception
     */
    public function testShortNameWithArray()
    {
        $object = array('hello','world');

        ReflectionHelper::getShortName($object);
    }

    public function testShortNameWithObject()
    {
        $object = new App\Models\User;

        $classNameExpected = 'User';

        $className = ReflectionHelper::getShortName($object);
        
        $this->assertEquals($classNameExpected,$className);
    }
}
