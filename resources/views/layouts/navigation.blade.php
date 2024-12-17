<div class="vh-100 border-end">
    <ul class="nav border-bottom px-3 flex-column pt-3 pb-3 mb-2">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/">
                <x-application-logo />
            </a>
        </li>
    </ul>
    <ul id="dashboard-nav" class="nav px-3 flex-column ps-3">
        <li class="nav-item">
            <a class="nav-link rounded py-3 fw-500 {{ request()->routeIs('home') ? 'active' : '' }}"
               aria-current="page" href="{{ route('home') }}">
                <i class="bi bi-house-door-fill ms-2 me-3 rounded-pill"></i> Início
            </a>
        </li>
        <li class="nav-item rounded">
            <a class="nav-link py-3 rounded fw-500 {{ str_contains(request()->path(), 'categorias') ? 'active' : '' }}"
               href="{{ route('categories.index') }}">
                <i class="bi bi-grid-fill ms-2 me-3 rounded-pill"></i> Categorias
            </a>
        </li>

        <li class="nav-item rounded">
            <a class="nav-link py-3 rounded fw-500 {{ str_contains(request()->path(), 'artigos') && request()->path() != 'artigos/meus-artigos' ? 'active' : '' }}"
               href="{{ route('articles.index') }}">
                <i class="bi bi-newspaper ms-2 me-3 rounded-pill"></i> Artigos
            </a>
        </li>
        <li class="nav-item rounded">
            <a class="nav-link py-3 rounded fw-500 {{ str_contains(request()->path(), 'artigos/meus-artigos') ? 'active' : '' }}"
               href="{{ route('articles.my-articles') }}">
               <i class="bi bi-person-lines-fill ms-2 me-3 rounded-pill"></i> Meus artigos
            </a>
        </li>
        <li class="nav-item rounded">
            <a
                target="_blank"
                class="nav-link py-3 rounded fw-500"
                href="{{ route('welcome') }}"
            >
               <i class="bi bi-globe ms-2 me-3 rounded-pill"></i> Ir para o site
            </a>
        </li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link fw-500 i10-text-dark text-decoration-none">
                <i class="bi bi-box-arrow-left ms-2 me-3 rounded-pill"></i> Sair da aplicação
            </button>
        </form>

    </ul>
</div>
