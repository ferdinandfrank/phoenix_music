<?php

namespace App\Models;

use DB;


/**
 * App\Models\Settings
 *
 * @property int    $id
 * @property string $key
 * @property string $value
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereValue($value)
 * @mixin \Eloquent
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
        return self::getByName('title');
    }

    public static function pageKeywords() {
        return self::getByName('keywords');
    }

    public static function pageDescription() {
        return self::getByName('description');
    }

    public static function pageAuthor() {
        return self::getByName('author');
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

    public static function imprint() {
        return self::getByName('imprint');
    }

    public static function cover() {
        return self::getByName('cover');
    }

    public static function logo() {
        return self::getByName('logo');
    }

    public static function favicon() {
        return self::getByName('favicon');
    }

    public static function introVideo() {
        return self::getByName('intro_video');
    }

    public static function background() {
        return self::getByName('background');
    }

    /**
     * Gets the value settings by name.
     *
     * @param string $settingName
     *
     * @return string
     */
    public static function getByName($settingName) {
        return self::where('key', $settingName)->pluck('value')->first();
    }

    /**
     * Updates the model in the database.
     *
     * @param  array $attributes
     *
     * @return bool
     */
    public static function updateAll(array $attributes = []) {
        DB::transaction(function () use ($attributes) {
            foreach ($attributes as $attribute => $value) {
                $setting = Settings::where('key', $attribute)->first();
                if (!empty($setting)) {
                    $setting->value = $value;
                    $setting->update();
                }
            }
        });

        return true;
    }

}
