<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_code' => fake()->words(2, true),
            'date_time' => fake()->dateTime(),
            'brand' => fake()->words(3, true),
            'quantity' => fake()->numberBetween(1, 99999),
            'unit_cost' => fake()->numberBetween(0, 10000),
            'adjustment' => fake()->numberBetween(0, 1000),
            'merchant_name' => fake()->name(),
            'merchant_contact' => fake()->phoneNumber(),
            'carrier_name' => fake()->name(),
            'carrier_contact' => fake()->phoneNumber(),
            'border' => fn($attrs) => isset($attrs['type']) && $attrs['type'] == 'in'?fake()->words(3, true):null,
            'remarks' => fake()->paragraph(),
        ];
    }
}
