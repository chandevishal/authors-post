<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::select('id')->get();
        return [
            'user_id' => $this->faker->randomElement($users),
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph(),
            'tags' => $this->faker->word(),
        ];
    }
}
