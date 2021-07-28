<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->buildingNumber(),
            'name' => $this->faker->unique()->colorName(),
            'credit' => '4.0',
            'description' => $this->faker->realText(20),
            'department_id' => rand(1, 5),
            'semester_id' => rand(1, 3)
        ];
    }
}