<?php

namespace App\GardenRevolution\Helpers;

use App\GardenRevolution\Helpers\ArrayStringNumberSeparator as Separator;

/**
 * This class helps persist plant related models.
 *
 * @package App\GardenRevolution\Helpers
 */
class PlantRepositoryRelatedModels extends Separator {

    /**
     * @var PlantTolerationRepository
     */
    private $plantTolerationRepository;

    /**
     * @var PlantPositiveTraitRepository
     */
    private $plantPositiveTraitRepository;

    /**
     * @var PlantNegativeTraitRepository
     */
    private $plantNegativeTraitRepository;

    /**
     * @var SearchableNameRepository
     */
    private $searchableNameRepository;

    /**
     * @var SoilRepository
     */
    private $soilRepository;

    /**
     * Container for plant model.
     *
     * @var Plant
     */
    private $plant;

    public function __construct(
        $plantTolerationRepository,
        $plantPositiveTraitRepository,
        $plantNegativeTraitRepository,
        $searchableNameRepository,
        $soilRepository
    )
    {
        $this->plantTolerationRepository = $plantTolerationRepository;
        $this->plantPositiveTraitRepository = $plantPositiveTraitRepository;
        $this->plantNegativeTraitRepository = $plantNegativeTraitRepository;
        $this->searchableNameRepository = $searchableNameRepository;
        $this->soilRepository = $soilRepository;
    }

    /**
     * Call methods for persisting plant related models.
     *
     * @param $data Plant form fields.
     * @param $plant Plant model instance.
     */
    public function storePlantRelatedModels($data, $plant)
    {
        $this->plant = $plant;

        $this->storeSearchableNames($data['searchable_names']);
        $this->storePlantTolerations($data['plant_tolerations']);
        $this->storePlantPositiveTraits($data['positive_traits']);
        $this->storePlantNegativeTraits($data['negative_traits']);
        $this->storePlantSoils($data['soils']);

    }

    /**
     * Store searchable names, checking if there's a new value or if it's already in
     * the database.
     * @param $values Corresponding values for form fields.
     */
    private function storeSearchableNames($values)
    {
        // Check if input field has numbers and strings,
        // string means value of field doesn't exist in the database e.g [10, 20, "New Tag"]
        if($this->hasNewValue($values))
        {
            // Retrieve new values (represented as strings)
            $newValues = $this->newInstance()->separate($values)->strings();

            foreach($newValues as $value)
            {
                $this->searchableNameRepository->create([

                    'searchable_id' => $this->plant->id,

                    'searchable_type' => 'App\Models\Plant',

                    'name' => $value

                ]);
            }

            // Store the rest of the input fields, after new values extraction
            // they're integers corresponding to id's in database.
            foreach($this->numbers() as $id){
                $searchableName = $this->searchableNameRepository->find($id);
                $this->plant->searchableNames()->save($searchableName);
            }
        }

        // There aren't any new fields to store.
        else {
            foreach ($values as $id) {
                $searchableName = $this->searchableNameRepository->find($id);
                $this->plant->searchableNames()->save($searchableName);
            }
        }
    }

    private function storePlantTolerations($values)
    {
        if($this->hasNewValue($values))
        {
            $newValues = $this->newInstance()->separate($values)->strings();

            $createdTolerations = [];

            foreach($newValues as $value)
            {
                $created = $this->plantTolerationRepository->create([

                    'toleration' => $value

                ]);

                $createdTolerations[] = $created->id;
            }

            $this->plant->tolerations()->attach(array_merge($this->numbers(), $createdTolerations));
        }

        else {
            $this->plant->tolerations()->attach($values);
        }
    }

    private function storePlantPositiveTraits($values)
    {
        if($this->hasNewValue($values))
        {
            $newValues = $this->newInstance()->separate($values)->strings();

            $createdPositiveTraits = [];

            foreach($newValues as $value)
            {
                $created = $this->plantPositiveTraitRepository->create([

                    'characteristic' => $value

                ]);

                $createdPositiveTraits[] = $created->id;
            }

            $this->plant->positiveTraits()->attach(array_merge($this->numbers(), $createdPositiveTraits));
        }

        else {
            $this->plant->positiveTraits()->attach($values);
        }
    }

    private function storePlantNegativeTraits($values)
    {
        if($this->hasNewValue($values))
        {
            $newValues = $this->newInstance()->separate($values)->strings();

            $createdNegativeTraits = [];

            foreach($newValues as $value)
            {
                $created = $this->plantNegativeTraitRepository->create([

                    'characteristic' => $value

                ]);

                $createdNegativeTraits[] = $created->id;
            }

            $this->plant->negativeTraits()->attach(array_merge($this->numbers(), $createdNegativeTraits));
        }

        else {
            $this->plant->negativeTraits()->attach($values);
        }
    }

    private function storePlantSoils($values)
    {
        if($this->hasNewValue($values))
        {
            $newValues = $this->newInstance()->separate($values)->strings();

            $createdSoils = [];

            foreach($newValues as $value)
            {
                $created = $this->soilRepository->create([

                    'soil_type' => $value

                ]);

                $createdSoils[] = $created->id;
            }

            $this->plant->soils()->attach(array_merge($this->numbers(), $createdSoils));
        }

        else {
            $this->plant->soils()->attach($values);
        }
    }

}