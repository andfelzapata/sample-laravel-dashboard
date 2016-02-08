<?php

namespace App\GardenRevolution\Repositories\Contracts;

interface Searchable {

    function search($query, $eagerLoads = []);

}