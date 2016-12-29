<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * UserUpdateRequest
 * -----------------------
 * Handles the rules for the request to update an user.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Requests
 */
class UserUpdateRequest extends FormRequest {

    /**
     * Determines if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Gets the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'      => 'required|max:' . config('validation.user.name.max'),
            'email'     => [
                'required',
                'email',
                'max:' . config('validation.user.email.max'),
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password'  => 'confirmed|max:' . config('validation.user.password.max') . '|min:' . config('validation.user.password.min'),
            'birthday'   => 'date',
            'url'       => 'url|max:' . config('validation.user.url.max'),
            'twitter'   => 'max:' . config('validation.user.twitter.max'),
            'facebook'  => 'max:' . config('validation.user.facebook.max'),
            'github'    => 'max:' . config('validation.user.github.max'),
            'linkedin'  => 'max:' . config('validation.user.linkedin.max'),
            'instagram' => 'max:' . config('validation.user.instagram.max'),
            'role'       => 'max:' . config('validation.user.role.max')
        ];
    }
}
