<x-app-layout>
    <div class="col-12 col-lg-10">
         <h1 class="mb-5 mt-3">Novo artigo</h1>
         <form
            action="{{ route('articles.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @include('components.forms.article')
            <div class="px-2">
               <button type="submit" class="btn i10-bg-gold text-light fw-500">
                    <i class="bi bi-check-lg me-1"></i> Salvar
               </button>
            </div>
        </form>
    </div>


</x-app-layout>
