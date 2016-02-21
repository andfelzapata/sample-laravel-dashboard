<?php

use Faker\Factory;
use App\Models\WebPage;

class WebPageModelTest extends TestCase {
    private $webPage;

    public function setUp() {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }

    public function testAddElement() {
        $webPage = new WebPage;

        $id = $this->faker->word();
        $value = $this->faker->text();

        $element = new stdClass();
        $element->$id = $value;

        $webPage->addElement($id,$value);
        
        $webPage->save();

        $encodedElement = json_encode($element);

        $this->assertEquals($webPage->elements,$encodedElement);
    }

    public function testAddElements() {
        $elements = array();
        $webPage = new WebPage;

        for( $i = 0; $i < 3; $i++)
        {
            $id = $this->faker->word();
            $value = $this->faker->text();

            $elements[$id] = $value;
        }

        $encodedElements = json_encode($elements);

        $webPage->addElements($elements);

        $webPage->save();

        $this->assertEquals($webPage->elements,$encodedElements);
    }
}   
