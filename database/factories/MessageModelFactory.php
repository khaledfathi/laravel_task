<?php

namespace Database\Factories;

use App\Models\MessageModel;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'body' => fake()->sentence(40),
            'hidden' => false,
            'parent_id' => fn() => \Illuminate\Support\Arr::random([null, MessageModel::inRandomOrder()->limit(1)->value('id')]),
            'user_id' => rand(1, 10),
        ];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (MessageModel $model) {
            if (rand(0, 3) > 0) { // Adjust the probability of having a parent
                $parent = MessageModel::inRandomOrder()->where('id', '!=', $model->id)->first();
                if ($parent) {
                    $model->update(['parent_id' => $parent->id]);
                }
            }
        });
    }
}
