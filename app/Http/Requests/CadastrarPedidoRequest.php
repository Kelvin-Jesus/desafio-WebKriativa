<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastrarPedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome_produto' => 'required|max:150',
            'id_produto' => 'required',
            'nome_cliente' => 'required|max:150',
            'id_cliente' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome_produto.required' => 'Nome do produto é obrigatório',
            'id_produto.required' => 'Id do produto é obrigatório',
            'nome_cliente.required' => 'Nome do cliente é obrigatório',
            'id_cliente.required' => 'Id do cliente é obrigatório',
        ];
    }
}
