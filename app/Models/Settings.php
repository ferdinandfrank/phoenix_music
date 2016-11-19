<?php

namespace App\Models;


/**
 * App\Models\Settings
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $key
 * @property string $value
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereValue($value)
 */
class Settings extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'key', 'value'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public static function pageTitle() {
        return self::getByName('page_title');
    }

    public static function pageKeywords() {
        return self::getByName('page_keywords');
    }

    public static function pageDescription() {
        return self::getByName('page_description');
    }

    public static function pageAuthor() {
        return self::getByName('page_author');
    }

    public static function amazon() {
        return self::getByName('amazon');
    }

    public static function iTunes() {
        return self::getByName('iTunes');
    }

    public static function cdbaby() {
        return self::getByName('cdbaby');
    }

    public static function audiojungle() {
        return self::getByName('audiojungle');
    }

    public static function stye() {
        return self::getByName('stye');
    }

    public static function facebook() {
        return self::getByName('facebook');
    }

    public static function twitter() {
        return self::getByName('twitter');
    }

    public static function youtube() {
        return self::getByName('youtube');
    }

    public static function about() {
        return self::getByName('about');
    }

    public static function textAudiojungle() {
        return self::getByName('text_audiojungle');
    }

    public static function textStye() {
        return self::getByName('text_stye');
    }

    public static function emailContact() {
        return self::getByName('email_contact');
    }

    public static function emailAdmin() {
        return self::getByName('email_admin');
    }



    /**
     * Gets the value settings by name.
     *
     * @param string $settingName
     * @return string
     */
    public static function getByName($settingName) {
        return self::where('key', $settingName)->pluck('value')->first();
    }

}
