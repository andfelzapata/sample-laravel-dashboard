<?php

use Faker\Factory;
use App\GardenRevolution\Notifications\NotifyAction;

class NotifyActionTest extends TestCase {
    private $faker;
    private $entities;
    private $notifyAction;

    public function setUp() {
        parent::setUp();
        $this->faker = Faker\Factory::create();
        $this->entities = $this->getEntities();
        $this->notifyAction = new NotifyAction;
    }

    public function getEntities() {
        return array('plant','user','pest','procedure','category','glossary term');
    }
    
    public function testGeneralMessage() {
        $this->assertEquals('news and updates',$this->notifyAction->general());
    }

    public function testEntityAddedMessage() {
        $entity = $this->faker->randomElement($this->entities);

        $this->assertEquals('new {$entity} is added',$this->notifyAction->added($entity));
    }
}   
