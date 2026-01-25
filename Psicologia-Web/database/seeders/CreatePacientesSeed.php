<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatePacientesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'Luiz 1 particular',
                'rules_id' => 4,
                'user_id' => 2,
                'planos_id' => 1,
                'cpf' => '08483171651',
                'telefone' => '(32)988097534',
                'endereco' => 'Casa',
                'cidade' => 'SJN',
                'estado' => 'MG',
                'status' => 'ativo',
                'atendimentos' => 0,
                'faltas' => 0,
                'saldo' => 0,
                'email' => 'paciente1@admin',
                'password' => bcrypt('123'),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Luiz 2 UNIMED',
                'rules_id' => 4,
                'user_id' => 2,
                'planos_id' => 2,
                'cpf' => '08483171651',
                'telefone' => '(32)988097534',
                'endereco' => 'Casa',
                'cidade' => 'SJN',
                'estado' => 'MG',
                'status' => 'ativo',
                'atendimentos' => 0,
                'faltas' => 0,
                'saldo' => 0,
                'email' => 'paciente2@admin',
                'password' => bcrypt('123'),
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
