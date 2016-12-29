<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;

class User extends SlugModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable, Authorizable, CanResetPassword, RoutesNotifications, HasDatabaseNotifications, HasResourceRoutes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'birthday',
        'role',
        'about',
        'image',
        'email',
        'facebook',
        'email',
        'password',
        'twitter',
        'linkedin',
        'instagram',
        'github',
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Checks if the user is a specific type of user.
     *
     * @param string|int
     *
     * @return bool
     */
    public function isType($type) {
        if (is_string($type)) {
            return $this->user_type == \Config::get('user_type.' . $type);
        }

        return $this->user_type == $type;
    }

    /**
     * Gets the user type as a localized string.
     *
     * @return array|null|string
     */
    public function getTypeAsString() {
        return \Lang::get('input.user_types.' . array_search($this->user_type, config('user_type')));
    }

    /**
     * Gets the attribute name of the model, that shall be used for the slug of the model.
     *
     * @return string
     */
    protected function getSlugName() {
        return $this->name;
    }

    /**
     * Gets the posts, that the user created.
     *
     * @return Track
     */
    public function tracks() {
        return $this->hasMany(Track::class, 'composer_id');
    }

    /**
     * Scope a query to only include admins and super admins.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMinManager($query) {
        return $query->where('user_type', config('user_type.admin'))->orWhere('user_type', config('user_type.manager'));
    }

    /**
     * Mutates the password to set for the user.
     *
     * @param $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
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
            return asset('assets/images/avatar_default.jpg');
        }

        return $value;
    }

}
