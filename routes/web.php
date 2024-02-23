<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('/clients', \App\Http\Controllers\ClientController::class);

    Route::get('/chart', function () {

        $fields = implode(',', \App\Models\SalesCommission::getColumns());

        $question = 'Gere um grafico das vendas por empresa no eixo y ao longo dos ultimos 5 anos';

       $config = \OpenAI\Laravel\Facades\OpenAI::completions()->create([
           'model'  =>  'gpt-3.5-turbo',
           'prompt' =>  "considerando a lista de campos ($fields), gere uma configuração json do vega-lite v5 (sem campos de dados e com descrição) que atenda o seguinte pedido $question. Resposta:",
           'max_tokens' =>  1500
       ])->choices[0]->text;
    });
});

require __DIR__.'/auth.php';
