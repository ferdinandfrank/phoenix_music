<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * TrackCreateRequest
 * -----------------------
 * Handles the rules for the request to create a new post.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Requests
 */
class TrackCreateRequest extends FormRequest {

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
            'title'    => 'required|max:' . config('validation.track.title.max'),
            'description' => 'required|max:' . config('validation.track.description.max'),
            'tags'     => 'max:' . config('validation.track.tags.max')
        ];
    }
}
