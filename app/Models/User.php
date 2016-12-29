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

/**
 * App\Models\User
 *
 * @property int                                                                                              $id
 * @property string                                                                                           $slug
 * @property string                                                                                           $name
 * @property string                                                                                           $email
 * @property string                                                                                           $password
 * @property int
 *           $user_type
 * @property \Carbon\Carbon                                                                                   $birthday
 * @property string                                                                                           $role
 * @property string                                                                                           $about
 * @property string                                                                                           $image
 * @property string                                                                                           $url
 * @property string                                                                                           $twitter
 * @property string                                                                                           $facebook
 * @property string                                                                                           $github
 * @property string                                                                                           $linkedin
 * @property string
 *           $instagram
 * @property string
 *           $remember_token
 * @property \Carbon\Carbon
 *           $created_at
 * @property \Carbon\Carbon
 *           $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Track[]                                $tracks
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\DatabaseNotification[]
 *                $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\DatabaseNotification[]
 *                $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUserType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAbout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereTwitter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFacebook($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGithub($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLinkedin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereInstagram($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User minManager()
 * @mixin \Eloquent
 */
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
        'user_type',
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
