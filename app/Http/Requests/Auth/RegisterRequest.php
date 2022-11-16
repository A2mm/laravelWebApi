<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Auth\RegisterDTO;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            "name"                  => ["required", "string", "min:3"],
            "email"                 => ["required", 'email', "unique:users,email"],
            "password"              => ["required", 'string', "confirmed"],
            "password_confirmation" => ["required", 'string'],

        ];
    }

    public function getDTO(): RegisterDTO
    {
       return new RegisterDTO($this->validated());
    }

}
