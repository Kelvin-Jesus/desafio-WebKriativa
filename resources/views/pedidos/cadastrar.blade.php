@component('components.Head')
    @slot('tituloDaPagina')
        @isset ($tituloDaPagina) {{ $tituloDaPagina }} @endif
    @endslot
@endcomponent

<body>

    @component ('components.Header') @endcomponent

    <main class="container">

        <h1 class="fs-1 mb-5 fw-bold text-center">Cadastrar Pedido</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('salvar-cadastro-pedido') }}" method="post" class="mt-5 d-flex flex-column justify-content-center">
            @csrf
            <div class="form-container mx-auto resultados-container">
                <div class="input-group mb-3 mx-auto">
                    <input type="search" class="form-control buscar-produto" placeholder="Buscar produto" aria-label="Buscar produto" aria-describedby="basic-addon2">
                    <span class="input-group-text bg-gradiente" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <div class="resultados-produtos d-none">
                    <ul>
                    </ul>
                </div>
                <label for="preco" class="form-label mt-3">Nome do produto</label>
                <div class="form-group mx-auto">
                    <input 
                        type="text" 
                        name="nome_produto"
                        readonly
                        required
                        class="form-control produto-cadastrar-nome" 
                        placeholder="Produto a ser cadastrado" 
                        aria-label="Produto a ser cadastrado" 
                        aria-describedby="basic-addon2"
                    >
                    <input 
                        type="hidden" 
                        name="id_produto"
                        readonly
                        required
                        class="form-control produto-cadastrar-id" 
                        placeholder="ID Produto a ser cadastrado" 
                        aria-label="ID Produto a ser cadastrado" 
                        aria-describedby="basic-addon2"
                    >
                </div>
            </div>
            <div class="form-container mx-auto mt-5 resultados-container">
                <div class="input-group mb-3 mx-auto">
                    <input type="search" class="form-control buscar-cliente" placeholder="Buscar cliente" aria-label="Buscar cliente" aria-describedby="basic-addon2">
                    <span class="input-group-text bg-gradiente" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
                <div class="resultados-clientes d-none">
                    <ul>
                    </ul>
                </div>
                <label for="preco" class="form-label mt-3">Nome do cliente</label>
                <div class="form-group mx-auto">
                    <input 
                        type="text" 
                        name="nome_cliente"
                        readonly
                        required
                        class="form-control cliente-cadastrar-nome" 
                        placeholder="Cliente dono do pedido" 
                        aria-label="Cliente dono do pedido" 
                        aria-describedby="basic-addon2"
                    >
                    <input 
                        type="hidden" 
                        name="id_cliente"
                        readonly
                        required
                        class="form-control cliente-cadastrar-id" 
                        placeholder="ID Cliente a ser cadastrado" 
                        aria-label="ID Cliente a ser cadastrado" 
                        aria-describedby="basic-addon2"
                    >
                </div>
            </div>
            <div class="form-group mx-auto">
                <label for="preco" class="form-label mt-3">Status do pedido</label>
                <select name="status" class="form-select" aria-label="Default select example" required>
                    <option selected value="1">Em Aberto</option>
                    <option value="2">Pago</option>
                    <option value="3">Cancelado</option>
                </select>
            </div>
            <div class="form-group mx-auto my-5">
                <a href="{{url()->previous()}}" class="btn btn-excluir">Cancelar</a>
                <button type="submit" class="btn btn-salvar">Cadastrar</a>
            </div>
        </form>
    </main>
    
</body>
@component('components.Footer') @endcomponent