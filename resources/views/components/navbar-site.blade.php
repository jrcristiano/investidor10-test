<nav class="navbar navbar-expand-lg bg-white shadow">
    <div class="container">
        <a class="navbar-brand" href="/">
            <x-home-logo/>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link rounded me-2 px-3 active" aria-current="page" href="/">
                        Início
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link px-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $category->shortened_name ?? 'Categorias' }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('welcome', ['categoria_id' => $category->id]) }}">
                                    {{ $category->shortened_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded me-2" href="#">
                    </a>
                </li>
            </ul>

            <form class="w-50 d-flex me-auto" role="search">
                <input
                    class="form-control me-2"
                    name="busca"
                    type="search"
                    placeholder="Pesquisar"
                    aria-label="Search"
                    value="{{ request('busca') }}"
                />

                <button class="btn btn-gold" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            @if (Route::has('login'))
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="btn-dashboard text-decoration-none rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                <i class="bi bi-bar-chart me-2"></i>Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn-login nav-link rounded me-2" aria-current="page" href="{{ route('login') }}">
                                Entrar
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn-cadastrar nav-link rounded" aria-current="page" href="{{ route('register') }}">
                                    Cadastrar
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
    </div>
</nav>
