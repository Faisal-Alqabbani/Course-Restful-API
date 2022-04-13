<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LessonTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'lesson_id' => $this->faker->numberBetween(1,100),
            'tag_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
