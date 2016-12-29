<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * AlbumCreateRequest
 * -----------------------
 * Handles the rules for the request to create a new post.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Requests
 */
class AlbumCreateRequest extends FormRequest {

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
            'title'        => 'required|max:' . config('validation.album.title.max'),
            'audiojungle'  => 'max:' . config('validation.album.audiojungle.max'),
            'stye'         => 'max:' . config('validation.album.stye.max'),
            'cdbaby'       => 'max:' . config('validation.album.cdbaby.max'),
            'amazon'       => 'max:' . config('validation.album.amazon.max'),
            'itunes'       => 'max:' . config('validation.album.itunes.max'),
            'published_at' => 'required|date',
        ];
    }
}
