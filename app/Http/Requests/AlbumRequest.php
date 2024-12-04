<?php

namespace App\Http\Requests;

use App\Models\Album;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $rules = [
            'album_name' => ['required']
        ];

        $album = $this->route()->album;

        if ($album) {
            $rules['album_name'][] = Rule::unique('albums')->ignore($album);
        } else {
            $rules['album_thumb'] = 'required|image';
            $rules['album_name'][] = Rule::unique('albums');
        }

        return $rules;
    }
}
