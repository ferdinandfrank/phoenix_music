<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * UserCreateRequest
 * -----------------------
 * Handles the rules for the request to create a new user.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Requests
 */
class UserCreateRequest extends FormRequest {

    /**
     * Determines if the user is authorized to make this request.
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
            'name' => 'required|max:' . config('validation.user.name.max'),
            'email'        => [
                'required',
                'email',
                'max:' . config('validation.user.email.max'),
                Rule::unique('users'),
            ],
            'user_type'    => 'required',
            'facebook'     => 'max:' . config('validation.user.facebook.max'),
            'job'          => 'max:' . config('validation.user.job.max')
        ];
    }
}
