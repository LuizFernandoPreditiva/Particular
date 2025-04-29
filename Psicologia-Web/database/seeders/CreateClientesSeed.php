<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class CreateClientesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            [
                'users_id' => '1',
                'planos_id' => '1',
                'nome' => 'Luiz 1 particular',
                'cpf' => '08483171651',
                'telefone' => '(32)988097534',
                'endereco' => 'Casa',
                'cidade' => 'SJN',
                'estado' => 'MG',
                'status' => 'ativo',
                'atendimentos' => 0,
                'faltas' => 0,
                'saldo' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'users_id' => '1',
                'planos_id' => '2',
                'nome' => 'Luiz 2 UNIMED',
                'cpf' => '08483171651',
                'telefone' => '(32)988097534',
                'endereco' => 'Casa',
                'cidade' => 'SJN',
                'estado' => 'MG',
                'status' => 'ativo',
                'atendimentos' => 0,
                'faltas' => 0,
                'saldo' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
