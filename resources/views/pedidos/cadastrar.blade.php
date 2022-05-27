@component('components.Head')
    @slot('tituloDaPagina')
        @isset ($tituloDaPagina) {{ $tituloDaPagina }} @endif
    @endslot
@endcomponent

<body>

    @component ('components.Header') @endcomponent

    <main class="container">
        <form action="" class="mt-5 row justify-content-center">
            @csrf
            <div class="input-group mb-3 w-50">
                <input type="text" class="form-control" placeholder="Filtrar itens" aria-label="Filtrar itens" aria-describedby="basic-addon2">
                <span class="input-group-text bg-gradiente" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>
        </form>
    </main>
    
</body>
@component('components.Footer') @endcomponent