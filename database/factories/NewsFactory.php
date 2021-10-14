<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->realTextBetween(50, 100),
            'text' => $this->faker->realTextBetween(250, 500),
            'is_published' => $this->faker->boolean(70),
            'published_at' => $this->faker->dateTimeBetween('-2 months'),
        ];
    }
}
