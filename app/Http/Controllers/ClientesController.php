<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CadastrarClienteRequest;
use App\Http\Requests\EditarClienteRequest;

class ClientesController extends Controller
{
     
    /**
     * listaDeClientes
     *
     * Tela de listagem de clientes
     * 
     * @return View
     */
    public function listaDeClientes() {
        return View('clientes.listagem', [
            'tituloDaPagina' => 'Listagem de Clientes',
            'clientes' => Cliente::paginate(4)
        ]);
    }
    
    /**
     * cadastrarCliente
     *
     * Tela de cadastro de clientes
     * 
     * @return View
     */
    public function cadastrarCliente() {
        return View('clientes.cadastrar', [
            'tituloDaPagina' => 'Cadastrar cliente',
        ]);
    }

    /**
     * salvarCadastroCliente
     * Recebe o nome do novo cliente e cadastra no banco de dados
     * 
     * @param  Class $request
     * @return void
     */
    public function salvarCadastroCliente(CadastrarClienteRequest $request) {

        $cadastrarCliente = Cliente::create(['nome_cliente' => $request->nome]);
        if (!$cadastrarCliente) {
            return redirect()->back()->withErrors('Erro ao cadastrar cliente!');
        }

        return redirect('clientes')->with('msg', 'Cliente cadastrado com sucesso!');
    }

    public function editarCliente($idCliente) {

        $cliente = Cliente::find($idCliente);

        if ( $cliente === null ) {
            return redirect()->back()->withErrors('Erro ao encontrar este cliente!');
        }
        
        return View('clientes.editar', [
            'cliente' => $cliente
        ]);

    }

    public function salvarEdicaoCliente(EditarClienteRequest $request) {

        $cliente = Cliente::where('id_cliente', $request->idCliente);
        if ( !$cliente ) {
            return 'nada';
        }

        $salvarEdicao = $cliente->update(['nome_cliente' => $request->nome]);
        if ( !$salvarEdicao ) {
            return redirect()->back()->withErrors('msg', 'Erro ao atualizar este cliente!');
        }

        return redirect('clientes')->with('msg', 'Cliente atualizado com sucesso!');
    }

    public function deletarCliente(Request $request) {

        if ( !$request->idCliente ) {
            return redirect()->back()->withErrors('msg', 'Id do cliente e obrigatório!');
        }

        $deletarCliente = Cliente::destroy('id_cliente', $request->idCliente);
        
        if ( !$deletarCliente ) {
            return redirect()->back()->withErrors('msg', 'Erro ao deletar esse cliente!');
        } 

        return redirect('clientes')->with('msg', 'Cliente deletado com sucesso!');
    }

}