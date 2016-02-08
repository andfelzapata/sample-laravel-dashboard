<?php

namespace App\Http\Controllers\Admin\Searches;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GardenRevolution\Repositories\Contracts\ProcedureRepositoryInterface;

class SearchProceduresController extends Controller
{
    /**
     * @var ProcedureRepository
     */
    private $procedureRepository;

    public function __construct(ProcedureRepositoryInterface $procedureRepository)
    {
        $this->procedureRepository = $procedureRepository;
    }

    /**
     * Perform a custom query on the procedure model.
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        $query = $request->input('procedure');

        $result = $this->procedureRepository->search($query, ['urgency', 'frequency']);

        return $result;
    }
}
