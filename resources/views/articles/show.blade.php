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
    @include('components.navbar-site', ['categories' => $categories])
        <div class="container w-45 mt-5">
            <div class="col">
                <h1 class="fw-bold i10-text-dark">{{ $article->title }}</h1>
                <h4 class="i10-text-dark line-height-2 i10-text-dark">{{ $article->subtitle }}</h4>
                <img class="d-block mx-auto my-4 w-100 rounded" src="{{ $article->banner }}" alt="Banner do artigo">
                <p class="text-justify line-height-1 fs-18">{{ $article->content }}</p>
            </div>
        </div>
    </div>
</body>
</html>
