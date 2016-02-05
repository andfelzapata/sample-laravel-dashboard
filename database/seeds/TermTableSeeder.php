<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\GardenRevolution\Repositories\Contracts\GlossaryRepositoryInterface;

class TermTableSeeder extends Seeder
{
    private $glossaryRepository;

    public function __construct(GlossaryRepositoryInterface $glossaryRepository) 
    {
        $this->glossaryRepository = $glossaryRepository;
     
        $this->faker = Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = $this->getTerms();

        foreach($terms as $term) {
            $this->glossaryRepository->create($term);
        }
    }

    private function getTerms()
    {
        $terms = array();

        for($i = 0; $i < 50; $i++)
        {
            $term['name'] = $this->faker->word;
            $term['description'] = $this->faker->text(140);
            $term['pronunciation'] = $this->faker->sentence(3,true);
            $term['meaning'] = $this->faker->text(80);

            $imageData = array('path'=>$this->faker->imageUrl(),'alt'=>$this->faker->sentence(3,true));

            $term['image'] = json_encode($imageData);
            $terms[] = $term;
        }

        return $terms;
    }
}
