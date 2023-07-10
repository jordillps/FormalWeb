<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'title:'. app()->getLocale() => ['required', 'string', 'max:400'],
            'excerpt:'. app()->getLocale() => ['required'],
            'iframe:'. app()->getLocale() => ['required','string'],
            'body:'. app()->getLocale() => ['required','string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
