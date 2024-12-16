<x-app-layout>
    <div class="d-block col-12 col-xl-10 py-4 bg-white px-0">
        @include('components.header-section', [
            'actionText' => 'Nova categoria',
            'routeName' => 'categories.create',
            'title' => 'Categorias'
        ])

        @include('components.alert-success')

        <div class="w-100 py-4 px-4">
            <form class="w-100 border rounded g-2 d-flex flex-nowrap" method="GET" action="{{ route('categories.index') }}">
                <div class="w-100 p-1 d-flex align-items-center shadow-sm">
                    @php
                        $searchValue = request('busca') ?? '';
                    @endphp
                    <input
                        name="busca"
                        type="text"
                        class="border-0 form-control form-control-lg"
                        placeholder="Buscar categoria por nome"
                        value="{{ $searchValue }}"
                    >
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
                        <th scope="col">Criada em</th>
                        <th scope="col">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($categories as $category)
                        <tr>
                            <th class="py-2 i10-text-dark" scope="row">{{ $category->id }}</th>
                            <td class="py-2 i10-text-dark">{{ $category->name }}</td>
                            <td class="py-2 i10-text-dark">{{ $category->created_at_formatted }}</td>
                            <td class="py-2 i10-text-dark">
                                <a class="btn i10-bg-gold text-light" href="{{ route('categories.edit', $category->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @if ($category->articles->count() > 0)
                                    <span data-bs-toggle="tooltip" title="Não é possível excluir uma categoria que possui artigos vinculados.">
                                        <button type="button" class="btn btn-danger disabled">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </span>
                                @else
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                      @empty
                        <tr>
                            <td class="text-center i10-text-dark" colspan="4">
                                Nenhum resultado foi encontrado...
                            </td>
                        </tr>
                      @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-100 py-2 px-3">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
