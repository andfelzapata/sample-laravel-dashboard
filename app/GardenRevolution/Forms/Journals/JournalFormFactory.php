<?php

namespace App\GardenRevolution\Forms\Journals;

/*
 * Class to return forms regarding plant request validation.
 */

class JournalFormFactory
{
    public function newGetJournalFormInstance()
    {
        return new GetJournalForm();
    }

    public function newUpdateJournalFormInstance()
    {
        return new UpdateJournalForm();
    }

    public function newStoreJournalFormInstance()
    {
        return new StoreJournalForm();
    }

    public function newDeleteJournalFormInstance()
    {
        return new DeleteJournalForm();
    }
}
