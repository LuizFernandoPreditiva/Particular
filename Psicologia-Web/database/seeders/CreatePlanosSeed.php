<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class CreatePlanosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planos')->insert([
            [
                'nome' => 'Particular',
                'descricao' => 'Voltado a clientes pagando por conta propria',
                'valor' => 100.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nome' => 'UNIMED',
                'descricao' => 'Voltado a clientes com guias da unimed',
                'valor' => 75.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
