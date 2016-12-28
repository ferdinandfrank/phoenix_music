<?php

namespace App\Models;

/**
 * App\Models\PageViews
 *
 * @property int $id
 * @property int $views_count
 * @property string $date
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageViews whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageViews whereViewsCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PageViews whereDate($value)
 * @mixin \Eloquent
 */
class PageViews extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_views';

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
        'views_count',
        'date'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public $page;

    /**
     * Creates a new PageViews instance.
     */
    public function __construct() {
        $this->page = \Lang::get('labels.general');
        parent::__construct();
    }


}
