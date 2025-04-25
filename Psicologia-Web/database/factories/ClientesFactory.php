<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $status = ['ativo', 'alta', 'inativo'];

        return [
            'users_id' => random_int(1, 2),
            'nome' => $this->faker->name,
            'cpf' => '084',
            'telefone' => $this->faker->phoneNumber,
            'endereco' => $this->faker->address,
            'cidade' => $this->faker->city,
            'estado' => $this->faker->stateAbbr,
            'status' => $this->faker->randomElement($status),
            'atendimentos' => $this->faker->randomNumber(2),
            'faltas' => $this->faker->randomNumber(2),
            'saldo' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
