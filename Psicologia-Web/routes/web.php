<?php

use App\Http\Controllers\AtendimentosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\PagamentosController;
use App\Http\Controllers\PlanosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
});

/*
Route::get('/welcome', function () {
    return view('welcome');
});
*/

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

require __DIR__.'/auth.php';

Route::get('/logado', function () {
    return view('logado');
})->middleware(['auth'])->name('logado');

//-------------------Clientes-------------------

Route::get('/pacientes/pesquisar/nome', [PacientesController::class, 'pesquisar'])->name('pacientes.pesquisar');

Route::match(['get', 'post'], '/pacientes/buscar', [PacientesController::class, 'buscar'])->name('pacientes.buscar')->middleware(['auth']);

Route::get('/pacientes/status/ativo', [PacientesController::class, 'ativo'])->name('pacientes.ativo');

Route::get('/pacientes/status/alta', [PacientesController::class, 'alta'])->name('pacientes.alta');

Route::get('/pacientes/status/inativo', [PacientesController::class, 'inativo'])->name('pacientes.inativo');

Route::resource('/pacientes', PacientesController::class)->middleware(['auth']);

//-------------------End Clientes-------------------

//-------------------Pagamentos-------------------

Route::get('/pagamentos/pesquisar/nome', [PagamentosController::class, 'pesquisar'])->name('pagamentos.pesquisar')->middleware(['auth']);

Route::match(['get', 'post'], '/pagamentos/buscar', [PagamentosController::class, 'buscar'])->name('pagamentos.buscar')->middleware(['auth']);

Route::get('/pagamentos/historico/{paciente}', [PagamentosController::class, 'historico'])->name('pagamentos.historico')->middleware(['auth']);

Route::get('/pagamentos/create/{id}', [PagamentosController::class, 'create'])->name('pagamentos.novo')->middleware(['auth']);

Route::resource('/pagamentos', PagamentosController::class)->middleware(['auth']);

//-------------------End Pagamentos-------------------

//-------------------Atendimentos-------------------

Route::resource('/atendimentos', AtendimentosController::class)->middleware(['auth']);

Route::get('/atendimentos/registro/{paciente}', [AtendimentosController::class, 'registro'])->name('atendimentos.registro')->middleware(['auth']);
Route::get('/agenda', [AtendimentosController::class, 'agenda'])->name('atendimentos.agenda')->middleware(['auth']);

//-------------------End Atendimentos-------------------

//-------------------Planos-------------------

Route::resource('/planos', PlanosController::class)->middleware(['auth']);

//-------------------End Planos-------------------
