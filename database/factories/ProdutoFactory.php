<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word,
            'marca' => $this->faker->company,
            'quantidade' => $this->faker->numberBetween(1, 100),
            'valor' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
