<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * SettingsUpdateRequest
 * -----------------------
 * Handles the rules for the request to update the settings.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Requests
 */
class SettingsUpdateRequest extends FormRequest {

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
            'title'          => 'required',
            'description'    => 'required',
            'author'         => 'required',
            'email_contact'  => 'required',
            'email_admin'    => 'required',
            'imprint'        => 'required',
            'privacy_policy' => 'required',
        ];
    }

}
