<?php

namespace Centrexbd\LivewireComments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Centrexbd\LivewireComments\Models\Comment;
use Centrexbd\LivewireComments\Models\User;


class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => fake()->text,
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'parent_id' => null,
            'commentable_type' => '\ArticleStub',
            'commentable_id' => 1,
            'created_at' => now()
        ];
    }
}