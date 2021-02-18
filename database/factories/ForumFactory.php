<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ForumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Forum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $values = [
            'title' => $this->faker->words(rand(3, 6), true),
            'description' => $this->faker->text(),
            'category_id' => rand(1, 3),
            'parent_id' => null,
            'last_post_id' => null,
            'order' => 10,
            'locked' => rand(0, 1),
            'show_on_index' => rand(0, 1),
            'topics_count' => 0,
            'posts_count' => 0,
        ];

        return [
            'title' => $values['title'],
            'description' => $values['description'],
            'slug' => Str::slug($values['title']),
            'category_id' => $values['category_id'],
            'parent_id' => $values['parent_id'],
            'last_post_id' => $values['last_post_id'],
            'order' => $values['order'],
            'locked' => $values['locked'],
            'show_on_index' => $values['show_on_index'],
            'topics_count' => $values['topics_count'],
            'posts_count' => $values['posts_count'],
        ];
    }
}
