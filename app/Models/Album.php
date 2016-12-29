<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Album extends SlugModel {

    use Searchable;
    use HasResourceRoutes;

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
        'tags',
        'image',
        'audiojungle',
        'stye',
        'cdbaby',
        'amazon',
        'itunes',
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
        return $this->hasMany(Track::class, 'album_id');
    }

    /**
     * Checks if the track is licensable.
     *
     * @return bool
     */
    public function isLicensable() {
        return !empty($this->audiojungle) || !empty($this->stye);
    }

    /**
     * Checks if the track is buyable.
     *
     * @return bool
     */
    public function isBuyable() {
        return !empty($this->cdbaby) || !empty($this->amazon) || !empty($this->itunes);
    }

    /**
     * Gets the image link of the track.
     *
     * @param $value
     *
     * @return string
     */
    public function getImageAttribute($value) {
        if (empty($value)) {
            return asset('assets/images/cover_default.jpg');
        }
        return $value;
    }
}