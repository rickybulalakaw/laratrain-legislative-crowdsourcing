<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'year' => $this->faker->numberBetween(1980, 2025),
            'bill_no' => $this->faker->numberBetween(1999, 100000),
            'summary' => $this->faker->paragraph(8),
            'user_id' => 1,
        ];
    }
}
