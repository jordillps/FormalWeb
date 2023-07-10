<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[A-ZÀÁÇÉÈËÏÍÌÓÒÚÙÜÚÑa-zàáçéèëïíóòúüñ. ]+$/','min:4'],
            'role_id' => 'required',
            'date_birth' => 'required|date',
            'email' =>  'required|unique:users',
            'password' => 'required|min:8|confirmed',
        ];
    }

   
}
