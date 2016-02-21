<?php

namespace App\GardenRevolution\Repositories\Contracts;

use App\Models\WebPage;

interface PageRepositoryInterface
{
    function find($id, $columns = array('*'));
    function save(WebPage $page);
    function delete($id);
}
