<?php

namespace App\GardenRevolution\Helpers;

use App\GardenRevolution\Helpers\ArrayStringNumberSeparator as Separator;

/**
 * This class helps persist procedure related models.
 *
 * @package App\GardenRevolution\Helpers
 */
class ProcedureRepositoryRelatedModels extends Separator {

    /**
     * @var SearchableNameRepository
     */
    private $searchableNameRepository;

    /**
     * Container for procedure model.
     *
     * @var Procedure
     */
    private $procedure;

    /**
     * @var
     */
    private $explodedValues;

    public function __construct($searchableNameRepository)
    {
        $this->searchableNameRepository = $searchableNameRepository;
    }

    /**
     * Call methods for persisting procedure related models.
     *
     * @param            $data
     * @param            $procedure
     */
    public function storeProcedureRelatedModels($data, $procedure)
    {
        $this->procedure = $procedure;

        $this->explodeInput($data['searchable_names'])->storeSearchableNames();

    }

    public function explodeInput($string)
    {

        $this->explodedValues = array_filter(explode(",", $string));

        return $this;
    }


    /**
     * Store searchable names, checking if there's a new value or if it's already in
     * the database.
     */
    private function storeSearchableNames()
    {
        if(isset($this->explodedValues))
        {
            if($this->hasNewValue($this->explodedValues))
            {
                $newValues = $this->newInstance()->separate($this->explodedValues)->strings();

                $createdSearchableNames = [];

                foreach($newValues as $value)
                {
                    $created = $this->searchableNameRepository->create([

                        'searchable_type' => 'App\Models\Procedure',

                        'name' => $value

                    ]);

                    $createdSearchableNames[] = $created->id;
                }

                $this->procedure->searchableNames()->sync(array_merge($this->numbers(), $createdSearchableNames));
            }

            else {
                $this->procedure->searchableNames()->sync($this->explodedValues);
            }
        }

    }
}