<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultadosController;

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
    return view('institucional/principal');
})->name('principal');

Route::get('/resultados', function () {
    return view('resultados/procurar');
})->name('resultados');

Route::post('/resultados/procurar',[ResultadosController::class, 'search'])->name('resultados.procurar');
