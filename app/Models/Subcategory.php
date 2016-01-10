<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * Return morphed category model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subcategorizable()
    {
        return $this->morphTo();
    }
}
