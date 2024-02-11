<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'prefixname'    =>  'string | max:255',
            'firstname'     =>  'required|string|max:255',
            'middlename'    =>  'string|max:255',
            'lastname'      =>  'string|max:255',
            'suffixname'    =>  'string|max:255',
            'username'      =>  'required|string|max:255',
            'email'         =>  'required|string|max:255',
            'password'      =>  'required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'required_with:password|min:8',
            'photo'         =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type'          =>  'string|max:255'
        ];
    }
}