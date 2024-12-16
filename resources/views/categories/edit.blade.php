<x-app-layout>
    <div class="col-12 col-lg-10">
         <h1 class="mb-5 mt-3">Editar Categoria</h1>
         <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST">
             @csrf
             @method('PUT')

             <div class="w-100 d-flex mb-3">
                 <div class="w-50 px-2">
                     <label for="name" class="mb-2 fw-500">
                         Nome <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Campo obrigatório">*</span>
                     </label>
                     <input
                         type="text"
                         name="name"
                         id="name"
                         class="form-control"
                         placeholder="Digite o nome da categoria..."
                         value="{{ old('name', $category->name) }}"
                         required
                     >
                 </div>
                 <div class="w-50 px-2">
                     <label for="slug" class="mb-2 fw-500">Slug</label>
                     <input
                         type="text"
                         name="slug"
                         id="slug"
                         class="form-control"
                         placeholder="Digite o slug da categoria..."
                         value="{{ old('slug', $category->slug) }}"
                     >
                 </div>
             </div>
             <div class="w-100 mb-3 px-2">
                 <label for="description" class="mb-2 fw-500">Descrição</label>
                 <textarea
                     type="text"
                     name="description"
                     id="description"
                     class="form-control w-100"
                     placeholder="Digite a descrição da categoria..."
                 >{{ old('description', $category->description) }}</textarea>
             </div>
             <div class="px-2">
                <button type="submit" class="btn i10-bg-gold text-light fw-500">
                    <i class="bi bi-check-lg me-1"></i> Salvar
                </button>
             </div>
         </form>
    </div>
</x-app-layout>
