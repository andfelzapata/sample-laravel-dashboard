<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Procedure;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProcedureUrgency;
use App\Models\Sponsor;
use App\Models\SearchableName;
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;

class ProcedureTableSeeder extends Seeder
{

    /**
     * @var ProcedureRepository
     */
    private $procedure;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(ProcedureRepositoryInterface $procedureRepository)
    {
        $this->procedure = $procedureRepository;

        $this->faker = Factory::create();

        $this->categories();

        $this->subcategories();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Procedure::truncate();

        $categories = Category::where('category_type', 'App\Models\Procedure')->lists('id')->toArray();

        $subcategories = Subcategory::where('subcategory_type', 'App\Models\Procedure')->lists('id')->toArray();

        $urgencies = ProcedureUrgency::lists('id')->toArray();

        $sponsor = Sponsor::lists('id')->toArray();

        foreach(range(1,200) as $index)
        {
            $this->procedure->create([

                'name' => ucfirst($this->faker->word()) . ' Procedure',

                'category_id' => $this->faker->randomElement($categories),

                'subcategory_id' => $this->faker->randomElement($subcategories),

                'urgency_id' => $this->faker->randomElement($urgencies),

                'how' => $this->faker->text . ' ' . $this->faker->text(),

                'why' => $this->faker->text . ' ' . $this->faker->text(),

                'main_image' => ['path' => 'somepath', 'description' => 'description', 'photo-credit' => 'photo credit'],

                'main_video' => ['path' => 'somepath', 'description' => 'description', 'video-credit' => 'video credit'],

                'sponsor_id' => $this->faker->randomElement($sponsor)

            ]);
        }


        $this->searchableNames();

    }

    /**
     * Define mock categories/subcategories.
     *
     * @return array
     */
    private function categoriesSubcategoriesNames()
    {
        return [

            'Asteraceae',

            'Asteraceae',

            'Campanulaceae',

            'Lamiaceae',

            'Scrophulariaceae',

            'Geraniaceae',

            'Lamiaceae',

            'Poaceae',

            'Asclepiadaceae',

            'Cannaceae',

            'Caryophyllaceae',

            'Lythraceae',

            'Lamiaceae',

            'Amaranthaceae',

            'Iridaceae',

            'Liliaceae',

            'Solanaceae',

            'Brassicaeae',

            'Geraniaceae',

        ];
    }

    /**
     * Persist categories.
     */
    private function categories()
    {
        $categories = $this->categoriesSubcategoriesNames();

        Category::create([

            'category_type' => 'App\Models\Procedure',

            'category' => 'none'

        ]);

        foreach(range(1,50) as $index)
        {
            Category::create([

                'category_type' => 'App\Models\Procedure',

                'category' => $this->faker->randomElement($categories) . $this->faker->word()

            ]);
        }
    }

    /**
     * Persist subcategories.
     */
    private function subcategories()
    {
        $categories = $this->categoriesSubcategoriesNames();

        Subcategory::create([

            'subcategory_type' => 'App\Models\Procedure',

            'subcategory' => 'none'

        ]);

        foreach(range(1,50) as $index)
        {
            Subcategory::create([

                'subcategory_type' => 'App\Models\Procedure',

                'subcategory' => $this->faker->randomElement($categories) . $this->faker->word()

            ]);
        }
    }

    /**
     * Persist searchable names for procedures.
     */
    private function searchableNames()
    {
        $procedures = Procedure::all();

        $searchableNames = new SearchableName();

        foreach(range(1,300) as $index)
        {
            SearchableName::create([

                'searchable_type' => 'App\Models\Procedure',

                'name' => $this->faker->word . ' ' . $this->faker->colorName
            ]);
        }

        $searchableNamesIds = $searchableNames->procedures()->lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $procedures[rand(1, 199)]->searchableNames()->attach($this->faker->randomElement($searchableNamesIds));
        }
    }

}
