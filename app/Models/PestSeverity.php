<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PestSeverity extends Model
{
    /**
     * Returns pests that have the given severity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pests()
    {
        return $this->hasMany('App\Models\Pest');
    }

}
