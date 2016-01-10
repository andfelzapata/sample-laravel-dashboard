<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * Return morphed subcategory model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function categorizable()
    {
        return $this->morphTo();
    }

}
