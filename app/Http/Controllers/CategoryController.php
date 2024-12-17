<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return view('categories.index', [
                'categories' => $this->categoryService->getPaginatedCategoryList($request),
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar categorias: '.$e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('categories.create');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar o formulário de criação de categoria: '.$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->only(array_keys($request->rules()));

            $savedCategory = $this->categoryService->saveCategory($data);

            return redirect()->route('categories.index')
                ->with('success', "Categoria {$savedCategory->name} foi criada com sucesso.");
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao criar categoria: '.$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {
            return view('categories.edit', [
                'category' => $this->categoryService->findCategoryByIdOrFail($id),
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->withErrors(['error' => 'Categoria não encontrada.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar categoria para edição: '.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        try {
            $category = $this->categoryService->findCategoryByIdOrFail($id);

            $data = $request->only(array_keys($request->rules()));

            $this->categoryService->saveCategory($data, $id);

            return redirect()->route('categories.index')
                ->with('success', "Categoria {$category->name} foi editada com sucesso.");
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->withErrors(['error' => 'Categoria não encontrada.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao editar categoria: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $category = $this->categoryService->findCategoryByIdOrFail($id);

            $this->categoryService->deleteCategoryById($id);

            return redirect()->route('categories.index')
                ->with('success', "Categoria {$category->name} foi removida com sucesso.");
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->withErrors(['error' => 'Categoria não encontrada.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao remover categoria: '.$e->getMessage()]);
        }
    }
}
