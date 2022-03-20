<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::select('id')->get();
        $posts = Post::select('id')->get();
        return [
            'user_id' => $this->faker->randomElement($users),
            'post_id' => $this->faker->randomElement($posts),
            'comment' => $this->faker->sentence()
        ];
    }
}
