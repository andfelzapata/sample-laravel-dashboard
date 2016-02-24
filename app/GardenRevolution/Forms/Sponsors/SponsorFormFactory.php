<?php

namespace App\GardenRevolution\Forms\Sponsors;

/*
 * Class to return forms regarding sponsor request validation.
 */

class SponsorFormFactory
{
    public function newGetSponsorFormInstance()
    {
        return new GetSponsorForm();
    }

    public function newUpdateSponsorFormInstance()
    {
        return new UpdateSponsorForm();
    }

    public function newStoreSponsorFormInstance()
    {
        return new StoreSponsorForm();
    }

    public function newDeleteSponsorFormInstance()
    {
        return new DeleteSponsorForm();
    }
}
