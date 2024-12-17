<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private CategoryService $categoryService;

    private ArticleService $articleService;

    public function __construct(ArticleService $articleService, CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $articles = $this->articleService->getPaginatedArticleList($request);

            return view('articles.index', [
                'articles' => $articles,
                'categories' => $this->categoryService->getCategoryListWithIdAndName($request),
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar artigos: '.$e->getMessage()]);
        }
    }

    public function show(string $slug, Request $request)
    {
        try {
            return view('articles.show', [
                'article' => $this->articleService->findArticleBySlugOrFail($slug),
                'categories' => $this->categoryService->getPaginatedCategoryList($request),
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('articles.index')->withErrors(['error' => 'Artigo não encontrado.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar o artigo: '.$e->getMessage()]);
        }
    }

    public function getPaginatedArticleList(Request $request)
    {
        try {
            return view('articles.index', [
                'articles' => $this->articleService->getPaginatedArticleList($request),
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar artigos: '.$e->getMessage()]);
        }
    }

    public function getPaginatedArticleListByUserId(Request $request)
    {
        try {
            return view('articles.index', [
                'articles' => $this->articleService->getPaginatedArticleListByUserId($request),
                'categories' => $this->categoryService->getPaginatedCategoryList($request),
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar artigos: '.$e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            return view('articles.create', [
                'categories' => $this->categoryService->getCategoryListWithIdAndName($request),
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar categorias: '.$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        try {
            $data = $request->only(array_keys($request->rules()));

            $savedArticle = $this->articleService->saveArticle($data);

            return redirect()->route('articles.index')
                ->with('success', "Artigo {$savedArticle->title} foi criado com sucesso.");
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao criar artigo: '.$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
        try {
            return view('articles.edit', [
                'article' => $this->articleService->findArticleByIdOrFail($id),
                'categories' => $this->categoryService->getCategoryListWithIdAndName($request),
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('articles.index')->withErrors(['error' => 'Artigo não encontrado.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar artigo para edição: '.$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, int $id)
    {
        try {
            $data = $request->only(array_keys($request->rules()));

            $article = $this->articleService->findArticleByIdOrFail($id);

            $this->articleService->saveArticle($data, $id);

            return redirect()->route('articles.index')
                ->with('success', "Artigo {$article->title} foi editado com sucesso.");
        } catch (ModelNotFoundException $e) {
            return redirect()->route('articles.index')->withErrors(['error' => 'Artigo não encontrado.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao editar artigo: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $article = $this->articleService->findArticleByIdOrFail($id);

            $this->articleService->deleteArticleById($id);

            return redirect()->route('articles.index')
                ->with('success', "Artigo {$article->title} foi removido com sucesso.");
        } catch (ModelNotFoundException $e) {
            return redirect()->route('articles.index')->withErrors(['error' => 'Artigo não encontrado.']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao remover artigo: '.$e->getMessage()]);
        }
    }
}
