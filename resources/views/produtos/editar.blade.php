@component('components.Head')
    @slot('tituloDaPagina')
        @isset ($tituloDaPagina) {{ $tituloDaPagina }}
        @endif
    @endslot
@endcomponent
    <body class="bg-principal fonte-secundaria">
        
        @component('components.Header') @endcomponent

        <main class="container">

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

        <form 
            action="{{ route('salvar-edicao-produto', ['idProduto' => $produto->id_produto]) }}" 
            method="post" 
            class="form w-50 mt-5 m-auto"
        >
                @csrf
                <label for="nome" class="form-label">Título</label>
                <div class="form-group">
                    <input 
                        required 
                        type="text" 
                        name="titulo" 
                        id="nome" 
                        class="form-control @error('titulo') is-invalid @enderror" 
                        aria-label="{{ $produto->nome_produto }}" 
                        placeholder="{{ $produto->nome_produto }}" 
                        aria-describedby="basic-addon1"
                        value="{{ $produto->nome_produto }}"
                    >
                </div>
                <label for="preco" class="form-label mt-3">Preço</label>
                <div class="form-group">
                    <input 
                        required 
                        type="text" 
                        name="preco" 
                        id="preco" 
                        class="form-control @error('preco') is-invalid @enderror" 
                        aria-describedby="basic-addon2"
                        aria-label="{{ $produto->nome_produto }}" 
                        placeholder="{{ $produto->nome_produto }}" 
                        aria-describedby="basic-addon1"
                        value="{{ number_format($produto->preco, 2, ',', '.') }}"
                    >
                </div>
                <div class="form-group mt-3 d-flex gap-3 justify-content-end">
                    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('produtos') }}" class="btn btn-excluir">Cancelar</a>
                    <button type="submit" class="btn btn-salvar">Salvar</a>
                </div>
            </form>

        </main>

    </body>
@component('components.Footer') @endcomponent