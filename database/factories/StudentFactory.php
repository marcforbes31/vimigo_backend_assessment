<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $course = [
            'Software Engineering', 
            'Law', 
            'Network Engineering', 
            'Hotel Management', 
            'Chemical Engineering',
            'Architechture',
            'Environmental Science',
            'Sport Science'

        ];

        $coursepicker = $this->faker->randomElement($course);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'address' => $this->faker->streetAddress(),
            'course' => $coursepicker
        ];
    }
}
