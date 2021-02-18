<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $values = [
            'title' => $this->faker->words(rand(3, 6), true),
            'order' => 10
        ];

        return [
            'title' => $values['title'],
            'slug' => Str::slug($values['title']),
            'order' => $values['order']
        ];
    }
}
