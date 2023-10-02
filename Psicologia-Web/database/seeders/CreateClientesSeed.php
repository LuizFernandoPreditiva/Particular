<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            'nome' => 'Luiz',
            'cpf' => '084',
            'telefone' => '032',
            'endereco' => 'Casa',
            'cidade' => 'SJN',
            'estado' => 'MG',
            'status' => 'ativo',
            'atendimentos' => 0,
            'faltas' => 0,
            'saldo' => 0,
        ]);
    }
}
