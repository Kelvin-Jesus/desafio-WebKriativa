@component('components.Head')
    @slot('tituloDaPagina')
        @isset ($tituloDaPagina) {{ $tituloDaPagina }} @endif
    @endslot
@endcomponent

<body class="bg-principal fonte-secundaria">

    @component ('components.Header') @endcomponent

    <main class="container">

        <h1 class="fs-1 mb-5 fw-bold text-center">Editar Pedido</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('salvar-edicao-pedido', ['idPedido' => $pedido->id_pedido]) }}" method="post" class="mt-5 d-flex flex-column justify-content-center">
            @csrf
            <div class="form-group mx-auto">
                <label for="preco" class="form-label mt-3">Status do pedido</label>
                <select name="status" class="form-select" aria-label="Default select example" required>
                    <option @if ($pedido->status_pedido === 'ABERTO') selected @endif value="1">Aberto</option>
                    <option @if ($pedido->status_pedido === 'PAGO') selected @endif value="2">Pago</option>
                    <option @if ($pedido->status_pedido === 'CANCELADO') selected @endif value="3">Cancelado</option>
                </select>
            </div>
            <div class="form-group mx-auto my-5 gap-3">
                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('clientes') }}" class="btn btn-excluir">Cancelar</a>
                <button type="submit" class="btn btn-salvar">Salvar</a>
            </div>
        </form>
    </main>
    
</body>
@component('components.Footer') @endcomponent