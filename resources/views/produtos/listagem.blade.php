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
                    <input 
                        type="text" 
                        class="form-control filtrar-itens" 
                        placeholder="Filtrar itens" 
                        aria-label="Filtrar itens" 
                        aria-describedby="basic-addon2"
                    >
                    <span class="input-group-text bg-gradiente" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <div class="">
                    <a href="{{ route('cadastrar-produto') }}" class="btn btn-custom">
                        cadastrar produto
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

            @if (isset($produtos) && $produtos !== null && !empty($produtos))
            <section class="table-responsive">
                <table class="table table-striped mt-5">
                    <thead>
                        <tr>
                            <th scope="col-1">#</th>
                            <th scope="col-4">Título</th>
                            <th scope="col-2">Data de cadastro</th>
                            <th scope="col-1">Preço</th>
                            <th scope="col-1">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->id_produto }}</td>
                                <td>{{ $produto->nome_produto }}</td>
                                <td>{{ Carbon\Carbon::parse($produto->data_criacao)->format('d-m-Y') }}</td>
                                <td>{{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td class="d-flex gap-3">
                                    <a 
                                        href="{{ route('editar-produto', ['idProduto'=>$produto->id_produto]) }}" 
                                        class="btn btn-editar"
                                    >Editar</a>
                                    <a 
                                        class="btn btn-excluir" 
                                        data-url="{{ route('deletar-produto', ['idProduto'=>$produto->id_produto]) }}"
                                    >Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $produtos->links('pagination::bootstrap-4') }}
            </section>
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