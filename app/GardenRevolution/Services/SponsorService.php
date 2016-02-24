<?php

namespace App\GardenRevolution\Services;

use Aura\Payload\PayloadFactory;
use App\GardenRevolution\Forms\Sponsors\SponsorFormFactory;
use App\GardenRevolution\Repositories\Contracts\SponsorRepositoryInterface;

class SponsorService extends Service {
    /**
     * @var SponsorRepository
     */
    private $sponsorRepository;

    /**
     * @var SponsorFormFactory
     */
    private $formFactory;

    public function __construct(
        PayloadFactory $payloadFactory,
        SponsorRepositoryInterface $sponsorRepository,
        SponsorFormFactory $formFactory
    )
    {
        $this->payloadFactory = $payloadFactory;
        $this->sponsorRepository = $sponsorRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * @param       $id
     * @param array $input
     *
     * @return mixed
     */
    public function update($id, array $input)
    {
        $form = $this->formFactory->newUpdateSponsorFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $sponsor = $this->sponsorRepository->update($input,$id);

        if( $sponsor )
        {
            return $this->updated($sponsor);
        }

        else
        {
            return $this->notUpdated($sponsor);
        }
    }

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input)
    {
        $form = $this->formFactory->newStoreSponsorFormInstance();

        if( ! $form->isValid($input) )
        {
            $data['errors'] = $form->getErrors();
            return $this->notAccepted($data);
        }

        $sponsor = $this->sponsorRepository->create($input);

        if( $sponsor )
        {
            return $this->created($sponsor);
        }

        else
        {
            return $this->notCreated();
        }
    }
}
