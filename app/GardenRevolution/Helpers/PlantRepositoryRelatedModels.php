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
     * @var Array
     */
    private $explodedValues;

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
     * @param            $data
     * @param            $plant
     */
    public function storePlantRelatedModels($data, $plant)
    {
        $this->plant = $plant;

        $this->explodeInput($data['searchable_names'])->storeSearchableNames();
        $this->explodeInput($data['plant_tolerations'])->storePlantTolerations();
        $this->explodeInput($data['positive_traits'])->storePlantPositiveTraits();
        $this->explodeInput($data['negative_traits'])->storePlantNegativeTraits();
        $this->explodeInput($data['soils'])->storePlantSoils();

        if(isset($data['associatedProcedures']))
        {
            $this->explodeInput($data['associatedProcedures'])->storePlantProcedures();
        }

        else
        {
            $this->removePlantProcedures();
        }

        if(isset($data['associatedPests']))
        {
            $this->explodeInput($data['associatedPests'])->storePlantPests();
        }

        else
        {
            $this->removePlantPests();
        }

    }

    /**
     * Check if input is a string of comma separated values,
     * if it is, turn into an array.
     * @param $variableInput
     *
     * @return $this
     */
    public function explodeInput($variableInput)
    {
        if(is_array($variableInput))
        {
            $this->explodedValues = $variableInput;

            return $this;
        }

        $this->explodedValues = array_filter(explode(",", $variableInput));

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

                        'searchable_type' => 'App\Models\Plant',

                        'name' => $value

                    ]);

                    $createdSearchableNames[] = $created->id;
                }

                $this->plant->searchableNames()->sync(array_merge($this->numbers(), $createdSearchableNames));
            }

            else {
                $this->plant->searchableNames()->sync($this->explodedValues);
            }
        }

    }

    private function storePlantTolerations()
    {
        if(isset($this->explodedValues))
        {
            if($this->hasNewValue($this->explodedValues))
            {
                $newValues = $this->newInstance()->separate($this->explodedValues)->strings();

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
                $this->plant->tolerations()->sync($this->explodedValues);
            }
        }
    }

    private function storePlantPositiveTraits()
    {
        if(isset($this->explodedValues))
        {
            if($this->hasNewValue($this->explodedValues))
            {
                $newValues = $this->newInstance()->separate($this->explodedValues)->strings();

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
                $this->plant->positiveTraits()->sync($this->explodedValues);
            }
        }
    }

    private function storePlantNegativeTraits()
    {
        if(isset($this->explodedValues))
        {
            if($this->hasNewValue($this->explodedValues))
            {
                $newValues = $this->newInstance()->separate($this->explodedValues)->strings();

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
                $this->plant->negativeTraits()->sync($this->explodedValues);
            }
        }
    }

    private function storePlantSoils()
    {
        if(isset($this->explodedValues))
        {
            if($this->hasNewValue($this->explodedValues))
            {
                $newValues = $this->newInstance()->separate($this->explodedValues)->strings();

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
                $this->plant->soils()->sync($this->explodedValues);
            }
        }
    }

    private function storePlantProcedures()
    {
        $this->plant->procedures()->sync($this->explodedValues);
    }

    private function removePlantProcedures()
    {
        $this->plant->procedures()->sync([]);
    }

    private function storePlantPests()
    {
        $this->plant->pests()->sync($this->explodedValues);
    }

    private function removePlantPests()
    {
        $this->plant->pests()->sync([]);
    }

}