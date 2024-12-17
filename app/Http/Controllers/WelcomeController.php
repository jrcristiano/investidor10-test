<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class WelcomeController extends Controller
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
            return view('welcome', [
                'articles' => $this->articleService->getPaginatedPublishedArticleList($request),
                'categories' => $this->categoryService->getCategoryListWithIdAndName($request),
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar a página inicial: '.$e->getMessage()]);
        }
    }
}
