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
use App\Models\PlantToleration;
use App\Models\PlantMoisture;
use App\Models\PlantPositiveTrait;
use App\Models\PlantNegativeTrait;
use App\Models\Sponsor;
use App\Models\Soil;
use App\Models\SearchableName;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;

class PlantTableSeeder extends Seeder
{

    /**
     * @var PlantRepositoryRepository
     */
    private $plant;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(PlantRepositoryInterface $plantRepository)
    {
        $this->plant = $plantRepository;

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

        $plantMoisture = PlantMoisture::lists('id')->toArray();

        $sponsor = Sponsor::lists('id')->toArray();

        $categories = Category::where('category_type', 'App\Models\Plant')->lists('id')->toArray();

        $subcategories = Subcategory::where('subcategory_type', 'App\Models\Plant')->lists('id')->toArray();

        foreach(range(1,900) as $index)
        {
            $this->plant->createForSeed([

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

                'plant_moisture_id' => $this->faker->randomElement($plantMoisture),

                'description' => $this->faker->text() . ' ' . $this->faker->text(),

                'notes' => $this->faker->text() . ' ' . $this->faker->text(),

                'main_image' => ['path' => 'somepath', 'description' => 'description', 'photo-credit' => 'photo credit'],

                'sponsor_id' => $this->faker->randomElement($sponsor)

            ]);
        }

        $this->soils();

        $this->tolerations();

        $this->positiveTraits();

        $this->negativeTraits();

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

            'category_type' => 'App\Models\Plant',

            'category' => 'none'

        ]);

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

        Subcategory::create([

            'subcategory_type' => 'App\Models\Plant',

            'subcategory' => 'none'

        ]);

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
        $plants = Plant::all();

        $searchableNames = new SearchableName();

        foreach(range(1,300) as $index)
        {
            SearchableName::create([

                'searchable_type' => 'App\Models\Plant',

                'name' => $this->faker->colorName .' '. $this->faker->word,
            ]);
        }

        $searchableNamesIds = $searchableNames->plants()->lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $plants[rand(1, 199)]->searchableNames()->attach($this->faker->randomElement($searchableNamesIds));
        }
    }


    /**
     * Persist relationships between plants and soils.s
     */
    private function soils()
    {
        $plants = Plant::all();

        $soilsIds = Soil::lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $plants[rand(1, 199)]->soils()->attach($this->faker->randomElement($soilsIds));
        }

    }

    private function tolerations()
    {
        $plants = Plant::all();

        $tolerationsIds = PlantToleration::lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $plants[rand(1, 199)]->tolerations()->attach($this->faker->randomElement($tolerationsIds));
        }
    }


    private function positiveTraits()
    {
        $plants = Plant::all();

        $positiveTraitsIds = PlantPositiveTrait::lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $plants[rand(1, 199)]->positiveTraits()->attach($this->faker->randomElement($positiveTraitsIds));
        }
    }


    private function negativeTraits()
    {
        $plants = Plant::all();

        $negativeTratisIds = PlantNegativeTrait::lists('id')->toArray();

        foreach(range(1,400) as $index) {

            $plants[rand(1, 199)]->negativeTraits()->attach($this->faker->randomElement($negativeTratisIds));
        }
    }

}