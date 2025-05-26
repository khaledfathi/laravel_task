<?php

namespace Database\Factories;

use App\Models\MessageModel;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'parent_id' => null,
            'user_id' => rand(1, 10),
            'created_at'=> fake()->dateTimeBetween('-1 years'),
        ];
    }

    public function replies ( int $parent_id){
        return $this->state(function () use ($parent_id){
            return ['parent_id' => $parent_id];
        });
    }
}
