<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rated>
 */
class RatedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment'=>$this->faker->sentence,
            'mark'=>$this->faker->numberBetween(1, 5),
            'laboratory_work_id'=>$this->faker->numberBetween(1, 10),
            'lesson_id'=>$this->faker->numberBetween(1, 10),
            'user_id'=>$this->faker->numberBetween(1, 10)
        ];
    }
}
