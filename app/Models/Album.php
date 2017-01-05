<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Album
 *
 * @property int                                                               $id
 * @property string                                                            $slug
 * @property string                                                            $title
 * @property string                                                            $description
 * @property string                                                            $tags
 * @property string                                                            $image
 * @property string                                                            $audiojungle
 * @property string                                                            $stye
 * @property string                                                            $cdbaby
 * @property string                                                            $amazon
 * @property string                                                            $itunes
 * @property \Carbon\Carbon                                                    $published_at
 * @property \Carbon\Carbon                                                    $created_at
 * @property \Carbon\Carbon                                                    $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Track[] $tracks
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereAudiojungle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereStye($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereCdbaby($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereAmazon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereItunes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Album whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
     * Gets the indexable data array for the model.
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
     * Gets the album's tracks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks() {
        return $this->hasMany(Track::class, 'album_id');
    }

    /**
     * Checks if the album is licensable.
     *
     * @return bool
     */
    public function isLicensable() {
        return !empty($this->audiojungle) || !empty($this->stye);
    }

    /**
     * Checks if the album is buyable.
     *
     * @return bool
     */
    public function isBuyable() {
        return !empty($this->cdbaby) || !empty($this->amazon) || !empty($this->itunes);
    }

    /**
     * Gets the image link of the album.
     *
     * @param $value
     *
     * @return string
     */
    public function getImageAttribute($value) {
        if (empty($value)) {
            return '/assets/images/cover_default.jpg';
        }

        return $value;
    }
}