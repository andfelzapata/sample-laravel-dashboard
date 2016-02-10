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


        if(isset($data['associatedPests']))
        {
            $this->explodeInput($data['associatedPests'])->storeProcedurePests();
        }

        else
        {
            $this->removeProcedurePests();
        }

        if(isset($data['associatedPlants']))
        {
            $this->explodeInput($data['associatedPlants'])->storeProcedurePlants();
        }

        else
        {
            $this->removeProcedurePlants();
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

    private function storeProcedurePlants()
    {
        $this->procedure->plants()->sync($this->explodedValues);
    }

    private function removeProcedurePlants()
    {
        $this->procedure->plants()->sync([]);
    }

    private function storeProcedurePests()
    {
        $this->procedure->pests()->sync($this->explodedValues);
    }

    private function removeProcedurePests()
    {
        $this->procedure->pests()->sync([]);
    }
}