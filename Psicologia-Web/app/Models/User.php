<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'rules_id',
        'user_id',
        'planos_id',
        'cpf',
        'telefone',
        'endereco',
        'cidade',
        'estado',
        'status',
        'atendimentos',
        'faltas',
        'saldo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pacientes(){
        return $this->hasMany(User::class, 'user_id');
    }

    public function psicologo(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function planos(){
        return $this->hasMany(Planos::class, 'user_id');
    }

    public function plano(){
        return $this->belongsTo(Planos::class, 'planos_id');
    }

    public function atendimentos(){
        return $this->hasMany(Atendimentos::class, 'user_id');
    }

    public function pagamentos(){
        return $this->hasMany(Pagamentos::class, 'user_id');
    }
}
