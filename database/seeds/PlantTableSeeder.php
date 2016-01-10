<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Plant;
use App\Models\PlantType;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Zone;
use App\Models\PlantAverageSize;
use App\Models\PlantGrowthRate;
use App\Models\PlantMaintenance;
use App\Models\PlantSunExposure;
use App\Models\Sponsor;
use App\Models\Soil;
use App\Models\SearchableName;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;

class PlantTableSeeder extends Seeder
{

    /**
     * @var PlantRepositoryRepository
     */
    private $plantRepositoryRepository;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(PlantRepositoryInterface $plantRepositoryRepository)
    {
        $this->plantRepositoryRepository = $plantRepositoryRepository;

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
        Plant::truncate();

        $commonNames = $this->commonNames();

        $botanicalNames = $this->botanicalNames();

        $plantTypes = PlantType::lists('id')->toArray();

        $plantZones = Zone::lists('id')->toArray();

        $plantAverageSize = PlantAverageSize::lists('id')->toArray();

        $plantGrowthRate = PlantGrowthRate::lists('id')->toArray();

        $plantMaintenance = PlantMaintenance::lists('id')->toArray();

        $plantSunExposure = PlantSunExposure::lists('id')->toArray();

        $sponsor = Sponsor::lists('id')->toArray();

        $soils = Soil::lists('id')->toArray();

        $categories = Category::lists('id')->toArray();

        $subcategories = Subcategory::lists('id')->toArray();

        foreach(range(1,200) as $index)
        {
            $this->plantRepositoryRepository->create([

                'plant_type_id' => $this->faker->randomElement($plantTypes),

                'common_name' => $this->faker->randomElement($commonNames),

                'botanical_name' => $this->faker->randomElement($botanicalNames),

                'category_id' => $this->faker->randomElement($categories),

                'subcategory_id' => $this->faker->randomElement($subcategories),

                'zone_id' => $this->faker->randomElement($plantZones),

                'plant_growth_rate_id' => $this->faker->randomElement($plantGrowthRate),

                'plant_average_size_id' => $this->faker->randomElement($plantAverageSize),

                'plant_maintenance_id' => $this->faker->randomElement($plantMaintenance),

                'plant_sun_exposure_id' => $this->faker->randomElement($plantSunExposure),

                'soils_id' => $this->faker->randomElement($soils),

                'moisture' => rand(20, 100) . "%",

                'description' => $this->faker->text(),

                'notes' => $this->faker->text(),

                'main_image' => ['paht' => 'somepath', 'description' => 'description', 'photo-credit' => 'photo credit'],

                'sponsor_id' => $this->faker->randomElement($sponsor)

            ]);
        }

    }


    /**
     * Define mock common names.
     *
     * @return array
     */
    private function commonNames()
    {
        return [

            'Ageratum',

            'American Marigold',

            'Annual Vinca',

            'Bacopa',

            'Balloon Flower',

            'Black-eyed Susan',

            'Bleeding-heart',

            'Blue Fescue',

            'Blue Sage',

            'Bluestem',

            'Butterfly-Weed',

            'Caladium',

            'Canna Lily',

            'China Pink',

            'Cigar Flower',

            'Coleus',

            'Common Yarrow',

            'Common Zinnia',

            'Coral Bells',

            'Creeping Zinnia'

        ];

    }

    /**
     * Define mock botanical names.
     *
     * @return array
     */
    private function botanicalNames()
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

            'Schizachyrium x',

            'Asclepias tuberosa',

            'Caladium x hortulanum',

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

        foreach(range(1,50) as $index)
        {
            Category::create([

                'category_type' => 'App\Models\Plant',

                'category' => $this->faker->randomElement($categories)

            ]);
        }
    }

    /**
     * Persist subcategories.
     */
    private function subcategories()
    {
        $categories = $this->categoriesSubcategoriesNames();

        foreach(range(1,50) as $index)
        {
            Subcategory::create([

                'subcategory_type' => 'App\Models\Plant',

                'subcategory' => $this->faker->randomElement($categories)

            ]);
        }
    }

    /**
     * Persist searchable names for plants.
     */
    private function searchableNames()
    {
        foreach(range(1,50) as $index)
        {
            SearchableName::create([

                'searchable_id' => rand(1,200),

                'searchable_type' => 'App\Models\Plant',

                'name' => $this->faker->colorName . $this->faker->name,

            ]);
        }
    }
}