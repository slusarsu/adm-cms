<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => fake()->text(50),
            'slug' => fake()->slug,
            'short' => fake()->text(),
            'content' => fake()->text(),
            'is_enabled' => true,
            'seo_title'=> fake()->text(50),
            'seo_text_keys'=> 'test1, test2, test3',
            'seo_description' => fake()->text(),
            'views' => rand(5,400),
        ];
    }
}
