<?php

use App\Models\Cliente;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware gClienteroup. Now create something great!
|
*/

Route::get('/', function () {
    // ['data' => Cliente::all()]
    return view('pedidos.listagem', [
        'tituloDaPagina' => 'Lista de Pedidos'
    ]);

})->name('pedidos');

// Cria um grupo com a rota dentro do pefio, assim cada rota dentro deste grupo
// automáticamente recebe o /nomeDaRota
// ex: /pedidos/cadastrar-pedido
Route::prefix('pedidos')->group(function () {

    Route::get('/cadastrar-pedido', function () {

        return view('pedidos.cadastrar', [
            'tituloDaPagina' => 'Cadastrar Pedido'
        ]);

    })->name('cadastrar-pedido');

});

Route::get('/produtos', function () {
    return 'produtos';
})->name('produtos');

Route::get('/clientes', [ClientesController::class, 'listaDeClientes'])->name('clientes');
Route::prefix('clientes')->group(function () {

    Route::get('/cadastrar-cliente', [ClientesController::class, 'cadastrarCliente'])
            ->name('cadastrar-cliente');

    Route::post('/salvar-cadastro-cliente', [ClientesController::class, 'salvarCadastroCliente'])
            ->name('salvar-cadastro-cliente');

    Route::get('/editar-cliente/{idCliente}', [ClientesController::class, 'editarCliente'])
            ->name('editar-cliente');
    
    Route::post('/editar-cliente/{idCliente}', [ClientesController::class, 'salvarEdicaoCliente'])
            ->name('salvar-edicao-cliente');

    Route::delete('/deletar-cliente/{idCliente}', [ClientesController::class, 'deletarCliente'])
            ->name('deletar-cliente');

});

Route::fallback(function () {
    return 'Nada aqui';
});
