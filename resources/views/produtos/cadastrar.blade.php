@component('components.Head')
    @slot('tituloDaPagina')
        @isset ($tituloDaPagina) {{ $tituloDaPagina }}
        @endif
    @endslot
@endcomponent
    <body class="bg-principal fonte-secundaria">
        @component('components.Header') @endcomponent

        <main class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('salvar-cadastro-produto') }}" method="post" class="form w-50 mt-5 m-auto">
                @csrf
                <label for="nome" class="form-label">Título</label>
                <div class="form-group">
                    <input 
                        required 
                        type="text" 
                        name="titulo" 
                        id="nome" 
                        class="form-control @error('nome') is-invalid @enderror" 
                        aria-label="Exemplo: Smartphone" 
                        placeholder="Ex: Smartphone" 
                        aria-describedby="basic-addon1"
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
                        aria-label="Exemplo: 3.999,99" 
                        placeholder="Ex: 3.999,99" 
                        aria-describedby="basic-addon2"
                    >
                </div>
                <div class="form-group mt-3 d-flex gap-3 justify-content-end">
                    <a href="{{url()->previous()}}" class="btn btn-excluir">Cancelar</a>
                    <button type="submit" class="btn btn-salvar">Salvar</a>
                </div>
            </form>
        </main>

    </body>

@component('components.Footer') @endcomponent