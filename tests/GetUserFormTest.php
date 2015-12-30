<?php

use Lang as l;
use Mockery as m;

class GetUserFormTest extends TestCase
{
    public function setUp() 
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }

    public function tearDown() 
    {
        parent::tearDown();
        m::close();
    }

    public function testIsValidSucces() 
    {
        $form = m::mock('App\GardenRevolution\Forms\Users\GetUserForm');

        $input = ['id'=>1];

        $form->shouldReceive('isValid')->with($input)->andReturn(true);

        $isValid = $form->isValid($input);

        $this->assertTrue($isValid);
    }

    public function testIsValidFailure() 
    {
        $form = m::mock('App\GardenRevolution\Forms\Users\GetUserForm');

        $input = ['id'=>str_random(5)];

        $form->shouldReceive('isValid')->with($input)->andReturn(false);
        
        $isValid = $form->isValid($input);
        
        $this->assertFalse($isValid);
    }

    public function testPreparedRules() 
    {
        $form = m::mock('App\GardenRevolution\Forms\Users\GetUserForm');

        $rules = ['id'=>'required|numeric'];

        $form->shouldReceive('getPreparedRules')->andReturn($rules);
        
        $preparedRules = $form->getPreparedRules();

        $this->assertEquals($rules,$preparedRules);
    }

    public function testGetErrors() 
    {
        $form = m::mock('App\GardenRevolution\Forms\Users\GetUserForm');

        $errors = array();

        for($i =0; $i < 5; $i++)
        {
            $errors[] = $this->faker->sentence;
        }

        $form->shouldReceive('getErrors')->andReturn($errors);

        $formErrors = $form->getErrors();
        $this->assertEquals($errors,$formErrors);
    }

    public function testWithEmptyInput() {
        $form = $this->app->make('App\GardenRevolution\Forms\Users\GetUserForm');
        $isValid = $form->isValid([]);

        $this->assertFalse($isValid);
    }

    public function testWithInvalidInput() {
        $form = $this->app->make('App\GardenRevolution\Forms\Users\GetUserForm');
        $input = ['name'=>$this->faker->name];
        $isValid = $form->isValid($input);

        $this->assertFalse($isValid);
    }

    public function testWithValidInput() {
        $form = $this->app->make('App\GardenRevolution\Forms\Users\GetUserForm');
        $input = ['id'=>$this->faker->randomDigitNotNull];
        $isValid = $form->isValid($input);

        $this->assertTrue($isValid);
    }

    public function testEmptyInputGetErrors() {
        $form = $this->app->make('App\GardenRevolution\Forms\Users\GetUserForm');
        $input = [];
        $errors = [
                    l::get('validation.required',['attribute'=>'id'])
                  ];

        $isValid = $form->isValid($input);
        
        $formErrors = $form->getErrors();

        $this->assertEquals($errors,$formErrors);
    }

    public function testInvalidInputGetErrors() {
        $form = $this->app->make('App\GardenRevolution\Forms\Users\GetUserForm');
        $input = ['id'=>$this->faker->name];
        $errors = [
                    l::get('validation.numeric',['attribute'=>'id'])
                  ];

        $isValid = $form->isValid($input);
        
        $formErrors = $form->getErrors();

        $this->assertEquals($errors,$formErrors);
    }

    public function testValidInput() {
        $form = $this->app->make('App\GardenRevolution\Forms\Users\GetUserForm');
        $input = ['id'=>$this->faker->randomDigitNotNull];
        
        $isValid = $form->isValid($input);

        $this->assertTrue($isValid);
    }

}
