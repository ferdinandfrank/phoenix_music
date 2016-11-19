<?php

namespace App\Models;


class Track extends SlugModel {

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'composer_id',
        'category_id',
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
     * Gets the corresponding user instance, which is the author of the post.
     *
     * @return User
     */
    public function composer() {
        return $this->belongsTo(User::class, 'composer_id');
    }

    /**
     *
     *
     * @return Category
     */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     *
     *
     * @return Album
     */
    public function album() {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function getImageAttribute($value) {
        if (empty($value)) {
            return asset('assets/images/covers/cover_default.jpg');
        }
        return asset('assets/images/covers/' . $value);
    }

    public function getFileAttribute($value) {
        return asset('assets/audio/' . $value);
    }
}