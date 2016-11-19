<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;


/**
 * SlugModel
 * -----------------------
 * Type of @link Model whose route key is a slug.
 * -----------------------
 *
 * @author  Ferdinand Frank
 * @version 0.1
 * @package Starmee\Models
 */
abstract class SlugModel extends BaseModel {

    /**
     * Gets the column name to use for resolving the model object.
     *
     * @return string
     */
    public function getRouteKeyName() {
        return 'slug';
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey() {
        return $this->getAttribute('slug');
    }

    /**
     * Listen for create event to save the slug.
     */
    protected static function boot() {
        parent::boot();
        static::saving(
            function($model) {
                if (empty($model->slug)) {
                    $slug = $model->createUniqueSlug();
                    $model->slug = $slug;
                }
            }
        );
    }

    /**
     * Gets the attribute name of the model, that shall be used for the slug of the model.
     *
     * @return string
     */
    protected abstract function getSlugName();

    /**
     * Creates an unique slug for the model.
     *
     * @return string
     */
    protected function createUniqueSlug() {
        $slug = str_slug($this->getSlugName(), '-');
        $count = DB::table($this->getTable())
            ->where('slug', $slug)
            ->where($this->getKeyName(), '<>', $this->getKey())
            ->count();
        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }

    /**
     * Finds a slug model by its primary key or its slug name.
     *
     * @param $key
     * @return SlugModel
     */
    public static function findByKey($key) {
        $model = new static();

        return static::where($model->getKeyName(), $key)->orWhere($model->getRouteKeyName(), $key)->first();
    }

}
