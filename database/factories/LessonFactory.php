<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lesson>
 */
class LessonFactory extends Factory
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
            'date_of_lesson'=>$this->faker->dateTime($max = 'now', $timezone = null),
            'academic_load_id'=>$this->faker->numberBetween(1, 10),
            'lesson_type_id'=>$this->faker->numberBetween(1, 4)
        ];
    }
}
