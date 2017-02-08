<?php

namespace App\Models;

/**
 * Searchable
 * -----------------------
 * Type of @link Model that can be searched for by an user.
 * -----------------------
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Models
 */
trait Searchable {

    /**
     * Scopes a query by a search query to search on specific columns.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $searchQuery) {
        if (property_exists($this, 'searchable') && is_array($this->searchable)) {
            $iteration = 0;
            foreach ($this->searchable as $searchable) {
                if ($iteration == 0) {
                    $query->where($searchable, 'LIKE', "%$searchQuery%");
                } else {
                    $query->orWhere($searchable, 'LIKE', "%$searchQuery%");
                }
                $iteration++;
            }
        }

        return $query;
    }
}