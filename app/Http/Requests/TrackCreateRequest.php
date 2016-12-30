<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * TrackCreateRequest
 * -----------------------
 * Handles the rules for the request to create a new track.
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
            'title'        => 'required|max:' . config('validation.track.title.max'),
            'composer_id'  => 'required|exists:users,id',
            'file'         => 'required',
            'length'       => 'required',
            'bpm'          => 'required|integer',
            'audiojungle'  => 'max:' . config('validation.track.audiojungle.max'),
            'stye'         => 'max:' . config('validation.track.stye.max'),
            'cdbaby'       => 'max:' . config('validation.track.cdbaby.max'),
            'amazon'       => 'max:' . config('validation.track.amazon.max'),
            'itunes'       => 'max:' . config('validation.track.itunes.max'),
            'youtube'      => 'max:' . config('validation.track.youtube.max'),
            'published_at' => 'required|date',
        ];
    }
}
