<?php

namespace App\Models\Contracts;

interface WebPageInterface {
    function addElement($id, $value);

    function addElements(array $elements);
}
