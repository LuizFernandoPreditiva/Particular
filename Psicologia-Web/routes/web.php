<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PagamentosController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/logado', function () {
    return view('logado');
})->middleware(['auth'])->name('logado');

Route::resource('/clientes', ClientesController::class)->middleware(['auth']);

Route::get('/clientes/pesquisar/nome', [ClientesController::class, 'pesquisar'])->name('clientes.pesquisar');

Route::post('/clientes/buscar', [ClientesController::class, 'buscar'])->name('clientes.buscar')->middleware(['auth']);

Route::get('/clientes/status/ativo', [ClientesController::class, 'ativo'])->name('clientes.ativo');

Route::get('/clientes/status/alta', [ClientesController::class, 'alta'])->name('clientes.alta');

Route::get('/clientes/status/inativo', [ClientesController::class, 'inativo'])->name('clientes.inativo');

Route::get('/pagamentos/create/{id}', [PagamentosController::class, 'create'])->name('pagamentos.novo')->middleware(['auth']);

Route::resource('/pagamentos', PagamentosController::class)->middleware(['auth']);
