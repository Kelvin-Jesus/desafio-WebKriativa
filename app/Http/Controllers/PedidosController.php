<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\CadastrarPedidoRequest;

class PedidosController extends Controller
{

    protected $statusPedido = [
        1 => 'ABERTO',
        2 => 'PAGO',
        3 => 'CANCELADO'
    ];

    public function listarPedidos() {

        $pedidos = Pedido::with('cliente')->with('produto')->paginate(10);

        return View('pedidos.listagem', [
            'tituloDaPagina' => 'Lista de pedidos',
            'pedidos' => $pedidos->isEmpty() ? null : $pedidos
        ]);
    }
    
    public function cadastrarPedido() {

        $existeProduto = Produto::get();
        $existeCliente = Cliente::get();

        if ( $existeProduto->isEmpty() || $existeCliente->isEmpty() ) {
            return redirect()
                    ->back()
                    ->withErrors(
                        'Não é possível cadastrar um pedido se não houver um produto ou cliente cadastrado'
                    );
        }

        return View('pedidos.cadastrar', [
            'tituloDaPagina' => 'Cadastrar Pedido'
        ]);

    }

    public function salvarCadastroPedido(CadastrarPedidoRequest $request) {
        $data = $request->only([
            'nome_produto',
            'id_produto',
            'nome_cliente',
            'id_cliente',
            'status',
        ]);

        $data['status'] = in_array($data['status'], array_keys($this->statusPedido)) ? $data['status'] : 1;

        $cadastrarPedido = Pedido::create([
            'id_cliente' => $data['id_cliente'],
            'id_produto' => $data['id_produto'],
            'status_pedido' => $this->statusPedido[$data['status']]
        ]);

        if (!$cadastrarPedido) {
            return redirect()->back()->withErrors('Erro ao cadastrar pedido!');
        }

        return redirect(route('pedidos'))->with('msg', 'Pedido cadastrado com sucesso!');
    }

    public function editarPedido($idPedido) {
        
        $pedido = Pedido::find($idPedido);

        if ( $pedido === null ) {
            return redirect()->back()->withErrors('Erro ao encontrar este pedido!');
        }

        return View('pedidos.editar', [
            'tituloDaPagina' => 'Editar Pedido',
            'pedido' => $pedido,
        ]);

    }

    public function salvarEdicaoPedido(Request $request) {
        
        $dados = $request->only([
            'idPedido',
            'status'
        ]);
        $pedido = Pedido::where('id_pedido', $request->idPedido);
        if ( !$pedido ) {
            return redirect()->back()->withErrors('msg', 'Erro ao encontrar este pedido!');
        }

        $dados['status'] = in_array($dados['status'], array_keys($this->statusPedido)) ? $dados['status'] : 1;

        $salvarEdicao = $pedido->update([
            'status_pedido' => $this->statusPedido[$dados['status']]
        ]);

        if ( !$salvarEdicao ) {
            return redirect()->back()->withErrors('Erro ao atualizar este pedido!');
        }

        return redirect(route('pedidos'))->with('msg', 'Pedido atualizado com sucesso!');

    }

    public function deletarPedido(Request $request) {

        if ( !$request->idPedido ) {
            return redirect()->back()->withErrors('msg', 'Id do pedido é obrigatório!');
        }

        $deletarPedido = Pedido::destroy('id_pedido', $request->idPedido);
        
        if ( !$deletarPedido ) {
            return redirect()->back()->withErrors('msg', 'Erro ao deletar esse produto!');
        } 

        return redirect(route('pedidos'))->with('msg', 'Pedido deletado com sucesso!');

    }

    public function buscarProdutos(Request $request) {

        if ( !$request->produto ) {
            return [];
        }

        $produtos = Produto::where('nome_produto', 'LIKE', '%'.$request->produto.'%')
                            ->get(['id_produto', 'nome_produto']);
        return $produtos;
    }

    public function buscarCliente(Request $request) {

        if ( !$request->cliente ) {
            return [];
        }

        $clientes = Cliente::where('nome_cliente', 'LIKE', '%'.$request->cliente.'%')
                            ->get(['id_cliente', 'nome_cliente']);
        return $clientes;
    }

}