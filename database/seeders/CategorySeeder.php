<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->create([
            'type' => 'demo',
            'content_type' => 'post',
            'title' => 'Category 1',
            'slug' => 'category-1',
            'order' => 1,
        ]);

        Category::query()->create([
            'type' => 'demo',
            'content_type' => 'post',
            'title' => 'Category 2',
            'slug' => 'category-2',
            'order' => 2,
        ]);

        Category::query()->create([
            'type' => 'demo',
            'content_type' => 'post',
            'title' => 'Category 3',
            'slug' => 'category-3',
            'order' => 3,
        ]);

        Category::query()->create([
            'type' => 'demo',
            'content_type' => 'post',
            'title' => 'Category 4',
            'slug' => 'category-4',
            'order' => 4,
        ]);

        Category::query()->create([
            'type' => 'demo',
            'content_type' => 'post',
            'title' => 'Category 5',
            'slug' => 'category-5',
            'order' => 5,
        ]);

        $posts = Post::all();

        foreach ($posts as $post) {
            $random = rand(1,5);
            $post->categories()->attach($random);
        }
    }
}
