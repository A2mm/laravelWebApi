<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Posts\FetchPostsWithFilterDTO;
use Illuminate\Validation\Rule;

class FetchPostsWithFilterRequest extends FormRequest
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

            "search"        => ["nullable", "string"],
           // "description"  => ["required", "string"],
            "user_id"      => ["nullable", 'integer'],
           // "image"        => ["nullable"],
            // "phone_number" => ["required"],

        ];
    }

    public function getDTO(): FetchPostsWithFilterDTO
    {
       return new FetchPostsWithFilterDTO($this->validated());
    }

}
