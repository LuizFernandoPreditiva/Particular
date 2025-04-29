<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'endereco',
        'cidade',
        'estado',
        'saldo',
        'atendimentos',
        'faltas',
        'status',
        'users_id',
        'planos_id'
    ];

    public function pagamentos(){
        return $this->hasMany(Pagamentos::class, 'cliente_id');
    }

    public function atendimentos(){
        return $this->hasMany(Atendimentos::class, 'cliente_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function plano(){
        return $this->belongsTo(Planos::class, 'plano_id');
    }

}
