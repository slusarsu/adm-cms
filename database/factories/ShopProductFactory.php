<?php

namespace Database\Factories;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopProduct>
 */
class ShopProductFactory extends Factory
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
            'price' => fake()->randomDigit(),
            'sku' => Str::random(5),
            'quantity' => rand(5,400),
            'shop_category_id' => rand(1,5),
        ];
    }
}
