<?php

use Faker\Factory;

use Illuminate\Database\Seeder;

use App\Models\WebPage;
use App\GardenRevolution\Repositories\Contracts\PageRepositoryInterface;

class PageTableSeeder extends Seeder
{
    private $faker;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->faker = Faker\Factory::create();
        $this->pageRepository = $pageRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $pages = array();

        for( $i = 0; $i < 50; $i++)
        {
            $page = new WebPage;
            
            $page->title = $this->faker->word();

            $tags = array();

            $count = $this->faker->numberBetween(1,50);

            for( $j = 0; $j < $count; $j++ )
            {
                $id = $this->faker->word();
                $value = $this->faker->text();
                $page->addElement($id,$value);
            }

            $pages[] = $page;
        }


        foreach($pages as $page)
        {
            $this->pageRepository->save($page);
        }
    }
}
