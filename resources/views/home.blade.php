<x-app-layout>
    <div class="col-10 mt-4 mx-auto">
        <div class="w-100 vh-100">
            <h1 class="w-20 mb-4 i10-text-dark greetings rounded-pill p-3 mx-auto text-center">
                <i class="bi bi-person-circle"></i>
                Olá, {{ Auth::user()->name }}!
            </h1>

            <h3 class="text-center mb-4 i10-text-dark">
                Bem vindo(a) ao Painel de Administração da <strong>Investidor10</strong>.
            </h3>

            <h6 class="text-start ms-5 ps-4 mb-3 i10-text-dark">Links de acesso rápido</h6>
            <ul class="nav px-3 ps-3 d-flex justify-content-between mb-3">
                <li class="nav-item w-20 rounded">
                    <a class="nav-link py-3 active rounded" href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill ms-2 me-3 rounded-pill"></i> Início
                    </a>
                </li>
                <li class="nav-item w-20">
                    <a class="nav-link py-3 active rounded" href="{{ route('categories.index') }}">
                        <i class="bi bi-grid-fill ms-2 me-3 rounded-pill"></i> Categorias
                    </a>
                </li>
                <li class="nav-item w-20">
                    <a class="nav-link py-3 active rounded" href="{{ route('articles.index') }}">
                        <i class="bi bi-newspaper ms-2 me-3 rounded-pill"></i> Artigos
                    </a>
                </li>
                <li class="nav-item w-20">
                    <a href="{{ route('articles.my-articles') }}" class="nav-link py-3 active rounded">
                        <i class="bi bi-person-lines-fill ms-2 me-3 rounded-pill"></i>
                        Meus artigos
                    </a>
                </li>
            </ul>
            <ul class="nav px-3 ps-3 d-flex justify-content-evenly">
                <li class="nav-item w-100">
                    <a
                        target="_blank"
                        href="{{ route('welcome') }}"
                        class="nav-link text-center py-3 active rounded"
                    >
                        <i class="bi bi-globe ms-2 me-3 rounded-pill"></i>
                        Ir para o site
                    </a>
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>
