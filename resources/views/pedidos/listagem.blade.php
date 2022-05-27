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

            @if (isset($data) && $data !== null)
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
                        @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->id_cliente }}</td>
                            <td>{{ $d->nome_cliente }}</td>
                            <td>{{ $d->data_criacao }}</td>
                            <td><span class="status aberto">ABERTO</span></td>
                            <td class="d-flex justify-content-end gap-3">
                                <a href="" class="btn btn-editar">Editar</a>
                                <a class="btn btn-excluir">Excluir</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @else
                <p class="mt-5 text-center">Nenhum item encontrado!</p>
            @endif
            
        </main>

@component('components.Footer') @endcomponent