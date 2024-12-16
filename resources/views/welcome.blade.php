<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>
    @include('components.navbar-site')
    <div class="container mt-5">
        <h1 class="mb-4">Artigos</h1>
        @if($articles->isEmpty())
            <p class="i10-text-dark h5 text-center div-centralizada">
                <i class="bi bi-info-circle"></i>
                Nenhum artigo disponível no momento.
            </p>
        @else
            <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
                @foreach ($articles as $article)
                    <div class="col">
                        <div class="card h-100">
                            <a class="text-decoration-none" href="{{ route('articles.show', ['id' => $article->id, 'slug' => $article->slug]) }}">
                                <img src="{{ $article->asset_banner }}" class="card-img-top" alt="Banner do artigo">
                            </a>
                            <div class="card-body">
                                <div class="mb-2">
                                    <a
                                        class="text-decoration-none"
                                        href="{{ route('articles.show', ['id' => $article->id, 'slug' => $article->slug]) }}"
                                    >
                                        <h5 class="card-title i10-text-dark">{{$article->shortened_title}}</h5>
                                    </a>
                                    <p class="card-text i10-text-dark">{{$article->shortened_subtitle}}</p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a
                                        href="{{ route('articles.show', ['id' => $article->id, 'slug' => $article->slug]) }}"
                                        class="btn btn-gold"
                                    >
                                        Ver artigo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($articles->hasPages())
                    <div class="w-100 py-2 px-3">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</body>
</html>
