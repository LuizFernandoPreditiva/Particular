<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agendamento',
        'atendido',
        'duracao',
        'falta',
        'trabalho',
        'resumo'
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
