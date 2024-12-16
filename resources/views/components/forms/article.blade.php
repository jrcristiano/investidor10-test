<div class="w-100 px-2 mb-3">
    <label for="title" class="mb-2 fw-500">
        Título <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
    </label>
    <input
        type="title"
        name="title"
        id="title"
        class="form-control"
        placeholder="Digite o nome da categoria..."
        required
        value="{{ old('title', $article->title ?? null) }}"
    />
</div>
<div class="w-100 px-2 mb-3">
    <label for="subtitle" class="mb-2 fw-500">
        Subtítulo <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
    </label>
    <input
        type="text"
        name="subtitle"
        id="subtitle"
        class="form-control"
        placeholder="Digite o slug da categoria..."
        value="{{ old('subtitle', $article->subtitle ?? null) }}"
    >
</div>
<div class="w-100 px-2 mb-3">
    <label for="content" class="mb-2 fw-500">
        Banner <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
    </label>
    <input name="banner" class="form-control" type="file" id="banner">
</div>
<div class="w-100 mb-3 px-2">
    <label for="content" class="mb-2 fw-500">
        Conteúdo <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
    </label>
    <textarea
        cols="0"
        rows="10"
        type="text"
        name="content"
        id="content"
        class="form-control w-100"
        placeholder="Digite a descrição da categoria..."
    >
        {{ old('cont', $article->content ?? null) }}
    </textarea>
</div>
<div class="w-100 d-flex mb-3">
    <div class="w-50 px-2">
        <label for="status" class="mb-2 fw-500">
            Status <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
        </label>
        <select name="status" class="form-select" id="statusSelect" aria-label="Selecione o status">
            @php
                $status = $article->status ?? null;
            @endphp
            <option {{ $status == 'rascunho' ? 'selected' : '' }} value="rascunho">Rascunho</option>
            <option {{ $status == 'publicado' ? 'selected' : '' }} value="publicado">Publicado</option>
        </select>
    </div>
    <div class="w-50 px-2">
        <label for="category_id" class="mb-2 fw-500">
            Categoria <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
        </label>
        <select name="category_id" class="form-select" id="category_id" aria-label="Selecione o status">
            <option selected value="">Selecionar categoria</option>
            @php
                $articleCatId = $article->category_id ?? null;
            @endphp

            @foreach ($categories as $category)
                <option {{ $category->id == old('category_id', $category->id ?? null) ? 'selected' : '' }} value="{{ old('category_id', $category->id ?? null) }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
