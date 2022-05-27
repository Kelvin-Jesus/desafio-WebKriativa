<header class="container container-fluid py-4">
    <div class="row justify-content-between">
        <a href="/" class="col logo fonte-principal"><span class="cor-principal">I</span>-Buy</a>
        <nav class="navbar col-3 d-flex justify-content-between fonte-principal">
            <a href="{{ route('pedidos') }}" class="{{ Route::currentRouteName() === 'pedidos' ? 'ativo' : '' }}">Pedidos</a>
            <a href="{{ route('clientes') }}" class="{{ Route::currentRouteName() === 'clientes' ? 'ativo' : '' }}">Clientes</a>
            <a href="{{ route('produtos') }}" class="{{ Route::currentRouteName() === 'produtos' ? 'ativo' : '' }}">Produtos</a>
        </nav>
    </div>
</header>