<?php

namespace App\Http\Controllers\Admin\Searches;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Repositories\Contracts\PestRepositoryInterface;
use App\GardenRevolution\Transformers\PestTransformer;

class SearchPestsController extends Controller
{

    /**
     * @var PestRepositoryInterface
     */
    private $pestRepository;

    /**
     * @var PestTransformer
     */
    private $pestTransformer;

    public function __construct(PestRepositoryInterface $pestRepository, PestTransformer $pestTransformer)
    {
        $this->pestRepository = $pestRepository;

        $this->pestTransformer = $pestTransformer;
    }

    /**
     * Perform search on pests table by common name.
     *
     * @param Request $request
     *
     * @return array
     */
    public function search(Request $request)
    {
        $query = $request->input('pest');

        return $this->pestTransformer->transformCollection($this->pestRepository->search($query, ['severity']));
    }
}
