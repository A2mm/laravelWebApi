<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'title'             => $this->faker->word(),
            'description'       => $this->faker->sentence(150),
            'image'             => 'default.jpg',
            'phone_number'      => $this->faker->phoneNumber,
            'user_id'           => $this->faker->randomElement(User::pluck('id')),

        ];
    }
}
