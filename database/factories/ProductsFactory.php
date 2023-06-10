<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->realText(55),
            'description' => $this->faker->paragraph(1),
            'image' =>$this->faker->image(storage_path('app/public/images'),250,300,false,false),
            'price' => fake()->randomFloat(2, 10, 1000),
            'category_id'=>Category::first()->id,
            'stock' => fake()->numberBetween(1, 100),
            'status'=>$this->faker->boolean(),
        ];
    }
}
