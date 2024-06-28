<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'user_id' => User::factory(),
            'title' => $title,
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->text(200),
            'slug' => Str::slug($title, '-'),
            'featured_image' => $this->faker->imageUrl(),
            'published_at' => $this->faker->optional()->dateTime,
        ];
    }
}
