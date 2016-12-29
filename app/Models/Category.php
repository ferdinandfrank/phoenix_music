<?php

namespace App\Models;


use Laravel\Scout\Searchable;

class Category extends SlugModel {

    use Searchable;
    use HasResourceRoutes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        $array = [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
        ];

        return $array;
    }

    /**
     * Gets the attribute name of the model, that shall be used for the slug of the model.
     *
     * @return string
     */
    protected function getSlugName() {
        return $this->title;
    }

    /**
     * Get the posts relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tracks() {
        return $this->belongsToMany(Track::class, 'track_categories')->withTimestamps();
    }
}