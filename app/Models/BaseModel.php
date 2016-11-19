<?php

namespace App\Models;

use App\Utils\LocalDate;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {

    /**
     * The attributes that will be set to 'null', if there is no value on a database insert.
     *
     * @var array
     */
    protected $nullable = [];

    /**
     * Listens for save events.
     */
    protected static function boot() {
        parent::boot();
        static::saving(
            function ($model) {
                $model->setNullables($model);
            }
        );
    }

    /**
     * Sets empty nullable fields to null.
     *
     * @param BaseModel $model
     */
    protected function setNullables($model) {
        foreach ($model->attributes as $key => $value) {
            if (in_array($key, $this->nullable)) {
                $model->{$key} = !isset($value) || $value == '' ? null : $value;
            }
        }
    }

    /**
     * Returns a timestamp as a local DateTime object.
     *
     * @param  mixed $value
     * @return LocalDate
     */
    protected function asDateTime($value) {
        return LocalDate::instance(parent::asDateTime($value));
    }
}