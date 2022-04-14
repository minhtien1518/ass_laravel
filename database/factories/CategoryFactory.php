<?php

namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'description' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1),
            'parent_id'=> Category::all()->random()->id,
        ];
    }
}
