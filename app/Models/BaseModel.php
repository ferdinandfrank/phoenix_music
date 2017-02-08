<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {

    /**
     * Scopes a query to only include the model without the specified id.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array|string|int                      $id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIgnore($query, $id) {
        if (is_array($id)) {
            return $query->whereNotIn('id', $id);
        }

        return $query->where('id', '<>', $id);
    }
}