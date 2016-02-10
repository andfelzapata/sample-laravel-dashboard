<?php

namespace App\Http\Controllers\Admin\Searches;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Repositories\Contracts\PlantRepositoryInterface;
use App\GardenRevolution\Transformers\PlantTransformer;

class SearchPlantsController extends Controller {

    /**
     * @var PlantRepositoryInterface
     */
    private $plantRepository;

    /**
     * @var PlantTransformer
     */
    private $plantTransformer;

    public function __construct(PlantRepositoryInterface $plantRepository, PlantTransformer $plantTransformer)
    {
        $this->plantRepository = $plantRepository;

        $this->plantTransformer = $plantTransformer;
    }

    /**
     * Perform search on plants table by common name.
     *
     * @param Request $request
     *
     * @return array
     */
    public function search(Request $request)
    {
        $query = $request->input('plant');

        return $this->plantTransformer->transformCollection($this->plantRepository->search($query, ['category', 'maintenance']));
    }
}
