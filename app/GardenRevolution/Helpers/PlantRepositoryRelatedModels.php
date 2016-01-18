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
     * @var SponsorRepository
     */
    private $sponsorRepository;

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
        $soilRepository,
        $sponsorRepository
    )
    {
        $this->plantTolerationRepository = $plantTolerationRepository;
        $this->plantPositiveTraitRepository = $plantPositiveTraitRepository;
        $this->plantNegativeTraitRepository = $plantNegativeTraitRepository;
        $this->searchableNameRepository = $searchableNameRepository;
        $this->soilRepository = $soilRepository;
        $this->sponsorRepository = $sponsorRepository;
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
        if($this->hasNewValue($values))
        {
            $newValues = $this->newInstance()->separate($values)->strings();

            $createdSearchableNames = [];

            foreach($newValues as $value)
            {
                $created = $this->searchableNameRepository->create([

                    'searchable_type' => 'App\Models\Plant',

                    'name' => $value

                ]);

                $createdSearchableNames[] = $created->id;
            }

            $this->plant->searchableNames()->sync(array_merge($this->numbers(), $createdSearchableNames));
        }

        else {
            $this->plant->searchableNames()->sync($values);
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

            $this->plant->tolerations()->sync(array_merge($this->numbers(), $createdTolerations));
        }

        else {
            $this->plant->tolerations()->sync($values);
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

            $this->plant->positiveTraits()->sync(array_merge($this->numbers(), $createdPositiveTraits));
        }

        else {
            $this->plant->positiveTraits()->sync($values);
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

            $this->plant->negativeTraits()->sync(array_merge($this->numbers(), $createdNegativeTraits));
        }

        else {
            $this->plant->negativeTraits()->sync($values);
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

            $this->plant->soils()->sync(array_merge($this->numbers(), $createdSoils));
        }

        else {
            $this->plant->soils()->sync($values);
        }
    }


}