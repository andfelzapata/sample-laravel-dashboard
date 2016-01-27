<?php

namespace App\GardenRevolution\Helpers;

use App\GardenRevolution\Helpers\ArrayStringNumberSeparator as Separator;

/**
 * This class helps persist pest related models.
 *
 * @package App\GardenRevolution\Helpers
 */
class PestRepositoryRelatedModels extends Separator {

    /**
     * @var SearchableNameRepository
     */
    private $searchableNameRepository;

    /**
     * Container for pest model.
     *
     * @var Pest
     */
    private $pest;

    /**
     * @var
     */
    private $explodedValues;

    public function __construct($searchableNameRepository)
    {
        $this->searchableNameRepository = $searchableNameRepository;
    }

    /**
     * Call methods for persisting pest related models.
     *
     * @param            $data
     * @param            $pest
     */
    public function storePestRelatedModels($data, $pest)
    {
        $this->pest = $pest;

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

                        'searchable_type' => 'App\Models\Pest',

                        'name' => $value

                    ]);

                    $createdSearchableNames[] = $created->id;
                }

                $this->pest->searchableNames()->sync(array_merge($this->numbers(), $createdSearchableNames));
            }

            else {
                $this->pest->searchableNames()->sync($this->explodedValues);
            }
        }

    }
}