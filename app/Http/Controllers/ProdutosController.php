<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditarClienteRequest;
use App\Http\Requests\EditarProdutoRequest;
use App\Http\Requests\CadastrarClienteRequest;
use App\Http\Requests\CadastrarProdutoRequest;

class ProdutosController extends Controller
{
     
    /**
     * listaDeClientes
     *
     * Tela de listagem de clientes
     * 
     * @return View
     */
    public function listaDeProdutos() {
        return View('produtos.listagem', [
            'tituloDaPagina' => 'Lista de Produtos',
            'produtos' => Produto::paginate(4)
        ]);
    }
    
    /**
     * cadastrarCliente
     *
     * Tela de cadastro de clientes
     * 
     * @return View
     */
    public function cadastrarProduto() {
        return View('produtos.cadastrar', [
            'tituloDaPagina' => 'Cadastrar produto',
        ]);
    }

    /**
     * salvarCadastroCliente
     * Recebe o nome do novo cliente e cadastra no banco de dados
     * 
     * @param  Class $request
     * @return void
     */
    public function salvarCadastroProduto(CadastrarProdutoRequest $request) {

        $preco = $this->fomatarPreco($request->preco);
        $cadastrarProduto = Produto::create([
            'nome_produto' => $request->titulo,
            'preco' => $preco
        ]);
        if (!$cadastrarProduto) {
            return redirect()->back()->withErrors('Erro ao cadastrar produto!');
        }

        return redirect('produtos')->with('msg', 'Produto cadastrado com sucesso!');
    }

    public function editarProduto($idProduto) {

        $produto = Produto::find($idProduto);

        if ( $produto === null ) {
            return redirect()->back()->withErrors('Erro ao encontrar este produto!');
        }
        
        return View('produtos.editar', [
            'produto' => $produto,
            'tituloDaPagina' => 'Editar Produto '.$produto->nome_produto
        ]);

    }

    public function salvarEdicaoProduto(EditarProdutoRequest $request) {

        $produto = Produto::where('id_produto', $request->idProduto);
        if ( !$produto ) {
            return redirect()->back()->withErrors('msg', 'Erro ao encontrar este produto!');
        }

        $preco = $this->fomatarPreco($request->preco);
        $salvarEdicao = $produto->update([
            'nome_produto' => $request->titulo,
            'preco' => $preco
        ]);

        if ( !$salvarEdicao ) {
            return redirect()->back()->withErrors('Erro ao atualizar este produto!');
        }

        return redirect('produtos')->with('msg', 'Produto atualizado com sucesso!');
    }

    public function deletarProduto(Request $request) {

        if ( !$request->idProduto ) {
            return redirect()->back()->withErrors('msg', 'Id do produto é obrigatório!');
        }

        $deletarProduto = Produto::destroy('id_produto', $request->idProduto);
        
        if ( !$deletarProduto ) {
            return redirect()->back()->withErrors('msg', 'Erro ao deletar esse produto!');
        } 

        return redirect('produtos')->with('msg', 'Produtos deletado com sucesso!');
    }

    private function fomatarPreco($preco) {
        $preco = str_replace('.', '', $preco);
        return str_replace(',', '.', $preco);
    }

}