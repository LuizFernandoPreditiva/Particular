<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'users_id',
    ];

    public function clientes(){
        return $this->hasMany(Clientes::class, 'plano_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

}
