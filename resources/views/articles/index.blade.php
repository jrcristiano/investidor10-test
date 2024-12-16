<x-app-layout>
    <div class="d-block col-12 col-xl-10 py-4 bg-white px-0">
        @include('components.header-section', [
            'actionText' => 'Novo artigo',
            'routeName' => 'articles.create',
            'title' => 'Artigos'
        ])

        @include('components.alert-success')

        <div class="w-100 py-4 px-4">
            <form class="w-100 g-2 d-flex flex-nowrap">
                <div class="w-100 d-flex align-items-center">
                    <div class="w-75 border p-1 shadow-sm rounded me-3">
                        @php
                            $searchValue = request('busca') ?? '';
                        @endphp
                        <input
                            name="busca"
                            type="text"
                            class="form-control border-0 form-control-lg"
                            placeholder="Buscar artigo por título"
                            value="{{ $searchValue }}"
                            autocomplete="off"
                        >
                    </div>
                    <div class="w-25 border p-1 rounded shadow-sm me-3">
                        <select
                            name="categoria_id"
                            class="form-select border-0 form-select-lg"
                            aria-label="Large select example"
                        >
                            <option value="" selected>Categoria</option>
                            @foreach ($categories as $category)
                                <option {{ request('categoria_id') == $category->id ? 'selected' : '' }} value={{ $category->id }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-lg btn-gold shadow-sm h-100 px-4"
                    >
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="w-100 py-3 px-4">
            <div class="border i10-table-rounded shadow-sm i10-data-list">
                <table class="table i10-table-rounded mb-0 align-middle table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Status</th>
                        <th scope="col">Criado em</th>
                        <th scope="col">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($articles as $article)
                        <tr>
                            <th class="py-2 i10-text-dark" scope="row">{{ $article->id }}</th>
                            <td class="py-2 i10-text-dark">{{ $article->shortened_title }}</td>
                            <td class="py-2">
                                <a
                                    class="i10-text-dark px-2 fw-500 text-decoration-none"
                                    href="{{ route('categories.edit', ['id' => $article->category->id ]) }}"
                                >
                                    {{ $article->category->name }}
                                </a>
                            </td>
                            <td class="py-2 i10-text-dark">
                                @php
                                    $badgeType = $article->formatted_status === 'Publicado' ? 'bg-success' : 'bg-secondary';
                                @endphp
                                <span class="badge rounded-pill {{$badgeType}}">
                                    {{ $article->formatted_status }}
                                </span>
                            </td>
                            <td class="py-2 i10-text-dark">{{ $article->formatted_created_at }}</td>
                            <td class="py-2 i10-text-dark">
                                <a class="btn i10-bg-gold text-light"  href="{{ route('articles.edit', $article->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir este artigo?')"
                                    >
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="text-center i10-text-dark" colspan="6">
                                    Nenhum resultado foi encontrado...
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-100 py-2 px-3">
            {{ $articles->links() }}
        </div>
    </div>
</x-app-layout>
