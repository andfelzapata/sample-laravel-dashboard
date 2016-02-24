<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Pest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\PestSeverity;
use App\Models\Sponsor;
use App\Models\SearchableName;
use App\GardenRevolution\Repositories\Contracts\PestRepositoryInterface;

class PestTableSeeder extends Seeder
{

    /**
     * @var PestRepositoryInterface
     */
    private $pest;

    public function __construct(PestRepositoryInterface $pestRepository)
    {
        $this->pest = $pestRepository;

        $this->faker = Factory::create();

        $this->categories();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pest::truncate();

        $commonNames = $this->commonNames();

        $latinNames = $this->latinNames();

        $categories = Category::where('category_type', 'App\Models\Pest')->lists('id')->toArray();

        $severities = PestSeverity::lists('id')->toArray();

        $sponsor = Sponsor::lists('id')->toArray();

        foreach(range(1,200) as $index)
        {
            $this->pest->createForSeed([

                'common_name' => $this->faker->randomElement($commonNames),

                'latin_name' => $this->faker->randomElement($latinNames),

                'category_id' => $this->faker->randomElement($categories),

                'severity_id' => $this->faker->randomElement($severities),

                'pest_description' => $this->faker->text . ' ' . $this->faker->text(),

                'damage_description' => $this->faker->text . ' ' . $this->faker->text(),

                'main_image' => ['path' => 'somepath', 'description' => 'description', 'photo-credit' => 'photo credit'],

                'main_video' => ['path' => 'somepath', 'description' => 'description', 'video-credit' => 'video credit'],

                'sponsor_id' => $this->faker->randomElement($sponsor)

            ]);
        }


        $this->searchableNames();

    }

    /**
     * Define mock common names.
     *
     * @return array
     */
    private function commonNames()
    {
        return [

            'Aphids',

            'Armyworms',

            'Asparagus Beetle',

            'Cabbage Looper',

            'Grasshopper',

            'Psyllid',

            'Slug & Snail',

            'Thrips',

            'Whiteflies',

            'Wireworm',

            'Earwig',

            'Fungus Gnats',

            'Leafminer',

            'Mealybugs',

            'Root Aphids',

            'Russet Mites',

            'Scale Insects',

            'Spider Mites',

            'Thrips',

            'Whiteflies'

        ];

    }

    /**
     * Define mock latin names.
     *
     * @return array
     */
    private function latinNames()
    {

        return [

            'Ageratum houstonianum',

            'Tagetes erecta',

            'Catharanthus roseus',

            'Sutera cordata',

            'Platycodon grandiflorus',

            'Monarda didyma',

            'Rudbeckia hirta',

            'Rudbeckia fulgida var. sullivantii',

            'Dicentra spectabilis',

            'Geranium sanguineum',

            'Festuca glauca',

            'Salvia farinacea',

            'Schizachyrium',

            'Asclepias tuberosa',

            'Caladium  hortulanum',

            'Canna generalis',

            'Dianthus chinensis',

            'Cuphea ignea',

            'Coleus	Solenostemon scutellaroides',

            'Achillea millefolium',

        ];

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

            'category_type' => 'App\Models\Pest',

            'category' => 'none'

        ]);

        foreach(range(1,50) as $index)
        {
            Category::create([

                'category_type' => 'App\Models\Pest',

                'category' => $this->faker->randomElement($categories) . $this->faker->word()

            ]);
        }
    }

    /**
     * Persist searchable names for pests.
     */
    private function searchableNames()
    {
        $pests = Pest::all();

        $searchableNames = new SearchableName();

        foreach(range(1,300) as $index)
        {
            SearchableName::create([

                'searchable_type' => 'App\Models\Pest',

                'name' => $this->faker->word . ' ' . $this->faker->colorName
            ]);
        }

        $searchableNamesIds = $searchableNames->pests()->lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $pests[rand(1, 199)]->searchableNames()->attach($this->faker->randomElement($searchableNamesIds));
        }
    }

}
