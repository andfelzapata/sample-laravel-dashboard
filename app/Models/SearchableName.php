<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchableName extends Model
{
    public function searchable()
    {
        return $this->morphTo();
    }
}
