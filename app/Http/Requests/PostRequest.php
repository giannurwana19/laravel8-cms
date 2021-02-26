<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['image', 'mimes:png,jpg', 'max:512'],
            'content' => ['required'],
            'published_at' => ['nullable'],
            'category_id' => ['nullable'],
            'tags' => ['nullable']
        ];
    }
}
