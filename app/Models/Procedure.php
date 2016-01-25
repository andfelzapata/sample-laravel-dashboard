<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    public function searchableNames()
    {
        return $this->belongsToMany('App\Models\SearchableName', 'procedure_searchable_name_pivot')->where('searchable_type', 'App\Models\Procedure');
    }
}
