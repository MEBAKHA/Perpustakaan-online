<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => $name,
            'slug' => str()->slug($name),
            'body' => fake()->paragraphs(3, true),
            'published_at' => fake()->boolean(70) ? fake()->dateTimeBetween('-5 years', 'now') : null,
            'category_id' => Category::inRandomOrder()->first()->id,
            'author_id' => Author::inRandomOrder()->first()->id,
        ]; 
    }
}
