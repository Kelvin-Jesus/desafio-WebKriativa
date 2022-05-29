    @component('components.Head')
        @slot('tituloDaPagina')
            @isset ($tituloDaPagina) {{ $tituloDaPagina }}
            @endif
        @endslot
    @endcomponent
    <body class="bg-principal fonte-secundaria">
        
        @component('components.Header') @endcomponent

        <main class="container">

            <div class="d-flex justify-content-end gap-3">
                <div class="input-group mb-3 w-50">
                    <input type="text" class="form-control" placeholder="Filtrar itens" aria-label="Filtrar itens" aria-describedby="basic-addon2">
                    <span class="input-group-text bg-gradiente" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <div class="">
                    <a href="{{ route('cadastrar-pedido') }}" class="btn btn-custom">
                        cadastrar pedido
                    </a>
                </div>
            </div>

            @if (Session::has('msg'))
                <div class="alert alert-success">{{ Session::get('msg') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (isset($pedidos) && $pedidos !== null)
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col-1">#</th>
                        <th scope="col-4">Título</th>
                        <th scope="col-2">Cliente</th>
                        <th scope="col-1">Status</th>
                        <th scope="col-1">Ações</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id_pedido }}</td>
                            <td>{{ $pedido->produto->nome_produto }}</td>
                            <td>{{ $pedido->cliente->nome_cliente }}</td>
                            <td><span class="status {{ strtolower($pedido->status_pedido) }}">{{ $pedido->status_pedido }}</span></td>
                            <td class="d-flex gap-3">
                                <a 
                                    href="{{ route('editar-pedido', ['idPedido'=>$pedido->id_pedido]) }}" 
                                    class="btn btn-editar"
                                >Editar</a>
                                <a 
                                    class="btn btn-excluir" 
                                    data-url="{{ route('deletar-pedido', ['idPedido'=>$pedido->id_pedido]) }}"
                                >Excluir</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            {{ $pedidos->links('pagination::bootstrap-4') }}
            @else
                <p class="mt-5 text-center">Nenhum item encontrado!</p>
            @endif
            
        </main>

        <section class="modal-bg hide">
            <div class="modal-container">
                <div class="modal-conteudo">
                    <h2 class="modal-titulo">Tem certeza que deseja deletar este item?</h2>
                    <form action="" method="POST">
                        @method('delete')
                        @csrf
                        <div class="form-group d-flex justify-content-center gap-3 mt-5">
                            <button type="submit" class="btn-salvar btn">Confirmar</button>
                            <a  class="btn-excluir btn">Cancelar</a>
                        </div>
                    </form>
                </div>

            </div>
        </section>

@component('components.Footer') @endcomponent