<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryService extends Service
{
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getCategoryListWithIdAndName(Request $request)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'withLimit' => false,
            'columns' => [
                'id',
                'name',
            ],
        ]);
    }

    public function getArticlesByCategorySlug(Request $request, string $slug)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'where' => [
                'slug' => $slug,
            ],
            'relations' => ['articles'],
            'columns' => ['id', 'name', 'slug'],
            'paginated' => true,
        ]);
    }

    public function getCategoryListWithSlugAndName(Request $request)
    {
        return $this->repository->fetchAll([
            ...$this->filters($request),
            'withLimit' => false,
            'columns' => [
                'slug',
                'name',
            ],
        ]);
    }
    public function getPaginatedCategoryList(Request $request)
    {
        $filters = $this->filters($request);

        $filters['paginated'] = true;

        if ($request->get('busca')) {
            $filters['whereILike'] = [
                'name' => $request->get('busca'),
            ];
        }

        return $this->repository->fetchAll($filters);
    }

    public function findCategoryByIdOrFail(int $id)
    {
        return $this->findOrFail($id);
    }

    public function saveCategory(array $data, int|null $id = null)
    {
        $data['user_id'] = Auth::user()->id;

        if ($id) {
            $data['id'] = $id;
            return $this->save($data);
        }

        return $this->save($data);
    }

    public function deleteCategoryById(int $id)
    {
        return $this->delete($id);
    }
}
