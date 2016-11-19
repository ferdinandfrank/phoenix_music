<?php

namespace App\Models;


class Album extends SlugModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'albums';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'published_at'
    ];

    /**
     * Gets the attribute name of the model, that shall be used for the slug of the model.
     *
     * @return string
     */
    protected function getSlugName() {
        return $this->title;
    }

    /**
     * Gets the posts, that the user created.
     *
     * @return Track
     */
    public function tracks() {
        return $this->hasMany(Track::class, 'category_id');
    }
}