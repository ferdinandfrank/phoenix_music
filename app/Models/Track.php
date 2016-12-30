<?php

namespace App\Models;


use App\Http\Middleware\VisitCounter;
use Laravel\Scout\Searchable;

/**
 * App\Models\Track
 *
 * @property int                                                                    $id
 * @property string                                                                 $slug
 * @property string                                                                 $title
 * @property string                                                                 $description
 * @property int                                                                    $composer_id
 * @property int                                                                    $album_id
 * @property string                                                                 $file
 * @property string                                                                 $length
 * @property int                                                                    $bpm
 * @property string                                                                 $tags
 * @property string                                                                 $image
 * @property string                                                                 $audiojungle
 * @property string                                                                 $stye
 * @property string                                                                 $cdbaby
 * @property string                                                                 $amazon
 * @property string                                                                 $itunes
 * @property string                                                                 $youtube
 * @property \Carbon\Carbon                                                         $published_at
 * @property \Carbon\Carbon                                                         $created_at
 * @property \Carbon\Carbon                                                         $updated_at
 * @property-read \App\Models\User                                                  $composer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[]   $categories
 * @property-read \App\Models\Album                                                 $album
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TrackViews[] $views
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereComposerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereLength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereBpm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereAudiojungle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereStye($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereCdbaby($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereAmazon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereItunes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereYoutube($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Track whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Track extends SlugModel {

    use Searchable;
    use HasResourceRoutes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tracks';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The attributes that will be set to 'null', if there is no value on a database insert.
     *
     * @var array
     */
    protected $nullable = ['album_id'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'composer_id',
        'album_id',
        'file',
        'length',
        'bpm',
        'tags',
        'image',
        'audiojungle',
        'stye',
        'cdbaby',
        'amazon',
        'itunes',
        'youtube',
        'published_at'
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
            'tags'        => $this->tags
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
     * Gets the corresponding user instance, which is the composer of the track.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function composer() {
        return $this->belongsTo(User::class, 'composer_id');
    }

    /**
     * Gets the categories relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'track_categories')->withTimestamps();
    }

    /**
     * Gets the album relationship of the track.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album() {
        return $this->belongsTo(Album::class, 'album_id');
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

    /**
     * Gets the post's views relationships.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views() {
        return $this->hasMany(TrackViews::class);
    }

    /**
     * Gets the post's views count.
     *
     * @return int
     */
    public function getViewsCount() {
        return VisitCounter::getTrackViewsCount($this);
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

}