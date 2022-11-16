<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Posts\CreatePostDTO;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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

            "title"        => ["required", "string"],
            "description"  => ["required", "string"],
            "image"        => ['nullable', 'mimes:png,gif,jpg,jpeg', 'max:2048'],
            "phone_number" => ["required"],

        ];
    }

    public function getDTO(): CreatePostDTO
    {
       return new CreatePostDTO($this->validated());
    }

}
