<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'author' => $this->faker->name(),
            'category_id' => mt_rand(1, 2), // Assigns a random existing category or default to 1
            'image_url' => 'https://picsum.photos/640/480?random=' . mt_rand(1, 1000),
            'published_at' => now(),
        ];
    }
}
