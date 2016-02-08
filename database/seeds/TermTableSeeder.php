<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\GardenRevolution\Helpers\CategoryTypeTransformer;

use App\GardenRevolution\Repositories\Contracts\GlossaryRepositoryInterface;

class TermTableSeeder extends Seeder
{
    private $glossaryRepository;
    private $categoryTypeTransformer;

    public function __construct(GlossaryRepositoryInterface $glossaryRepository, CategoryTypeTransformer $categoryTypeTransformer) 
    {
        $this->glossaryRepository = $glossaryRepository;
        $this->categoryTypeTransformer = $categoryTypeTransformer;
     
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
        $categoryTypes = $this->categoryTypeTransformer->getCategoryTypes();
        $categoryTypes = array_values($categoryTypes);

        for($i = 0; $i < 50; $i++)
        {
            $term['name'] = $this->faker->text(32);
            $term['description'] = $this->faker->text(140);
            $term['pronunciation'] = $this->faker->sentence(3,true);
            $term['meaning'] = $this->faker->text(80);
            $term['category_type'] = $this->faker->randomElement($categoryTypes);

            $relativePath = 'images/glossary';

            $path = $this->faker->image(sprintf('%s/%s',public_path(),$relativePath),640,480);
            $filename = basename($path);

            $relativePath = sprintf('%s/%s',$relativePath,$filename);

            $imageData = array('path'=>$relativePath,'alt'=>$this->faker->text(16));

            $term['image'] = json_encode($imageData);
            $terms[] = $term;
        }

        return $terms;
    }
}
