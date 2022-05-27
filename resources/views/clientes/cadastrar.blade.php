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
            <form action="{{route('salvar-cadastro-cliente')}}" method="post" class="form w-50 mt-5 m-auto">
                @csrf
                <label for="nome" class="form-label">Nome</label>
                <div class="form-group">
                    <input 
                    required 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    class="form-control @error('nome') is-invalid @enderror" 
                    aria-label="Exemplo: Eduardo Amaro" 
                    placeholder="Ex: Eduardo Amaro" 
                    aria-describedby="basic-addon1"
                    value="{{ old('nome') }}"
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