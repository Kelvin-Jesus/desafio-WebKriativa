<?php

use App\Models\Cliente;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;
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

Route::get('/', [PedidosController::class, 'listarPedidos'])->name('pedidos');

// Cria um grupo com a rota dentro do pefio, assim cada rota dentro deste grupo
// automáticamente recebe o /nomeDaRota
// ex: /pedidos/cadastrar-pedido
Route::prefix('pedidos')->group(function () {

    Route::get('/cadastrar-pedido', [PedidosController::class, 'cadastrarPedido'])->name('cadastrar-pedido');

    Route::post('/salvar-cadastro-pedido', [PedidosController::class, 'salvarCadastroPedido'])
            ->name('salvar-cadastro-pedido');

    Route::get('/editar-pedido/{idPedido}', [PedidosController::class, 'editarPedido'])
            ->name('editar-pedido');
    
    Route::post('/editar-pedido/{idPedido}', [PedidosController::class, 'salvarEdicaoPedido'])
            ->name('salvar-edicao-pedido');

    Route::delete('/deletar-pedido/{idPedido}', [PedidosController::class, 'deletarPedido'])
            ->name('deletar-pedido');

});

Route::get('/produtos', [ProdutosController::class, 'listaDeProdutos'])->name('produtos');
Route::prefix('produtos')->group(function () {

    Route::get('/cadastrar-produto', [ProdutosController::class, 'cadastrarProduto'])
            ->name('cadastrar-produto');

    Route::post('/salvar-cadastro-produto', [ProdutosController::class, 'salvarCadastroProduto'])
    ->name('salvar-cadastro-produto');

    Route::get('/editar-produto/{idProduto}', [ProdutosController::class, 'editarProduto'])
            ->name('editar-produto');
    
    Route::post('/editar-produto/{idProduto}', [ProdutosController::class, 'salvarEdicaoProduto'])
            ->name('salvar-edicao-produto');

    Route::delete('/deletar-produto/{idProduto}', [ProdutosController::class, 'deletarProduto'])
            ->name('deletar-produto');

});

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
