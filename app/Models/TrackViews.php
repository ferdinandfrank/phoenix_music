<?php

namespace App\Models;

/**
 * App\Models\TrackViews
 *
 * @property int $id
 * @property int $track_id
 * @property int $views_count
 * @property \Carbon\Carbon $date
 * @property mixed $page
 * @property \App\Models\Track $track
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BaseModel ignore($id)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackViews whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackViews whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackViews whereTrackId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TrackViews whereViewsCount($value)
 * @mixin \Eloquent
 */
class TrackViews extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'track_views';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'track_id',
        'views_count',
        'date'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Gets the corresponding post relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function track() {
        return $this->belongsTo(Track::class);
    }

    public function getPageAttribute() {
        return \Lang::get('labels.track') . ": " . $this->track->title;
    }
}
