<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:email|max:255',
            'name' => 'required|max:255',
            'password' => 'required|min:5'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.max' => 'Email max 255!',
            'name.required' => 'name is required!',
            'name.max' => 'name max 255!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password is too short',
        ];
    }
}
