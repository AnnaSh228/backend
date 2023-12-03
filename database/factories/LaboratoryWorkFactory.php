<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\laboratory_work>
 */
class LaboratoryWorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->word,
            'deadline'=>$this->faker->dateTime($max = 'now', $timezone = null),
            'maximum_score'=>$this->faker->numberBetween(1, 5),
            'discipline_id'=>$this->faker->numberBetween(1, 10)
        ];
    }
}
