<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;
use App\GardenRevolution\Forms\Journals\JournalFormFactory;
use App\GardenRevolution\Repositories\Contracts\JournalRepositoryInterface;

/**
 * Class containing all useful methods for business logic regarding journals
 */
class JournalService extends Service
{
    /**
     * @var JournalRepository
     */
    private $journalRepository;

    /**
     * @var PayloadFactory
     */
    protected $payloadFactory;

    /**
     * @var
     */
    private $formFactory;

    public function __construct(PayloadFactory $payloadFactory, JournalRepositoryInterface $journalRepository, JournalFormFactory $formFactory)
    {
        $this->journalRepository = $journalRepository;
        $this->payloadFactory = $payloadFactory;
        $this->formFactory = $formFactory;
    }

    /**
     * @param $pages
     * @param $eagerLoads
     * @return mixed
     */
    public function getJournals($pages, $eagerLoads)
    {
        $journals = $this->journalRepository->getAllPaginated($pages, $eagerLoads);

        if( $journals )
        {
            $data = [
                'journals'=> $journals
            ];

            return $this->success($data);
        }
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getJournal($id)
    {
        $data = [];

        $journal = $this->journalRepository->find($id);

        if( ! $journal) {
            $data['errors'] = 'not found';
            return $this->notAccepted($data);
        }

        $data['journal'] = $journal;

        return $this->found($data);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $data = [
            'journal' => $this->journalRepository->find($id),
        ];

        return $this->found($data);
    }

    /**
     * @param       $id
     * @param array $input
     *
     * @return mixed
     */
    public function update($id, array $input)
    {
        $form = $this->formFactory->newUpdateJournalFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $updated = $this->journalRepository->update($input, $id);

        if( $updated )
        {
            return $this->updated($updated);
        }

        else
        {
            return $this->notUpdated($updated);
        }
    }

    public function create()
    {
        $data = [
        ];

        return $this->success($data);
    }

    /**
     * @param array $input
     * @return mixed
     */
    public function store(array $input)
    {

        $form = $this->formFactory->newStoreJournalFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $journal = $this->journalRepository->create($input);

        if($journal)
        {
            return $this->created($journal);
        }

        return $this->notCreated();

    }

    public function delete($id)
    {
        $deleted = $this->journalRepository->delete($id);

        if( $deleted )
        {
            return $this->deleted();
        }

        else
        {
            return $this->notDeleted();
        }
    }

}
