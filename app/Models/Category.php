<?php

namespace App\Models;


class Category extends SlugModel {

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