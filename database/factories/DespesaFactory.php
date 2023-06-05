<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'despesas' => $this->faker->realTextBetween(25,45),
            'valor' => fake()->randomfloat(2, 10, 1000),
            'vencimento' => fake()->date(),
            'status' => fake()->boolean(),
            'pagamento' => fake()->date(),
            'obs' => fake()->sentence(5),
        ];
    }
}
