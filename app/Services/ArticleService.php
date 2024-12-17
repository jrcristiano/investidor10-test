<?php

namespace App\Services;

use App\Enums\ArticleStatus;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleService extends Service
{
    public function __construct(ArticleRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getPaginatedArticleListByUserId(Request $request)
    {
        $filters = $this->filters($request);

        if ($request->get('busca')) {
            $filters['whereILike'] = [
                'title' => $request->get('busca'),
            ];
        }

        if ($request->get('categoria_id')) {
            $filters['where'] = [
                'category_id' => $request->get('categoria_id'),
            ];
        }

        return $this->repository->fetchAll([
            ...$filters,
            'paginated' => true,
            'where' => [
                'user_id' => Auth::user()->id,
            ],
        ]);
    }

    public function findArticleBySlugOrFail(string $slug)
    {
        return $this->repository->findArticleBySlugOrFail($slug);
    }

    public function getPaginatedArticleList(Request $request)
    {
        $filters = $this->filters($request);

        $filters['relations'] = [
            'category',
        ];

        $filters['paginated'] = true;

        if ($request->get('busca')) {
            $filters['whereILike'] = [
                'title' => $request->get('busca'),
            ];
        }

        if ($request->get('categoria_id')) {
            $filters['where'] = [
                'category_id' => $request->get('categoria_id'),
            ];
        }

        return $this->repository->fetchAll($filters);
    }

    public function getPaginatedPublishedArticleList(Request $request)
    {
        $filters = $this->filters($request);

        $filters['where'] = [
            'status' => ArticleStatus::PUBLICADO->value,
        ];

        $filters['relations'] = [
            'category',
        ];

        $filters['paginated'] = true;

        if ($request->get('busca')) {
            $filters['whereILike'] = [
                'title' => $request->get('busca'),
            ];
        }

        if ($request->get('categoria_id')) {
            $filters['where'] = [
                ...$filters['where'],
                'category_id' => $request->get('categoria_id'),
            ];
        }

        return $this->repository->fetchAll($filters);
    }

    public function getPaginatedPublishedArticleListBySlug(Request $request, string $slug)
    {
        $filters = $this->filters($request);

        $filters['where'] = [
            'slug' => $slug,
            'status' => ArticleStatus::PUBLICADO->value,
        ];

        $filters['relations'] = [
            'category',
        ];

        $filters['paginated'] = true;

        if ($request->get('busca')) {
            $filters['whereILike'] = [
                'title' => $request->get('busca'),
            ];
        }

        if ($request->get('categoria_id')) {
            $filters['where'] = [
                ...$filters['where'],
                'category_id' => $request->get('categoria_id'),
            ];
        }

        return $this->repository->fetchAll($filters);
    }

    public function findArticleByIdOrFail(int $id)
    {
        return $this->findOrFail($id);
    }

    public function saveArticle(array $data, ?int $id = null)
    {
        $data['id'] = $id ?? null;

        $data['user_id'] = Auth::user()->id;

        if (! $id && $data['banner']) {
            $data['banner'] = '/'.$this->uploadImage('banner');
            $data['slug'] = Str::slug($data['title']);

            return $this->save($data);
        }

        $article = $this->find($id);

        if (isset($data['banner'])) {
            $data['banner'] = $this->updateImage($data, 'banner', $article->banner);
        }

        return $this->save($data);
    }

    public function deleteArticleById(int $id)
    {
        $article = $this->findOrFail($id);

        if ($article->banner) {
            $this->deleteImage($article->banner);
        }

        return $this->delete($id);
    }

    public function uploadImage(string $inputName)
    {
        $request = request();

        if (! $request->hasFile($inputName) || ! $request->file($inputName)->isValid()) {
            return null;
        }

        $file = $request->file($inputName);

        $uploadedFileName = $this->generateFilePath($file);

        $path = $file->storeAs('/', $uploadedFileName, 'public');

        $data[$inputName] = $path;

        return $data[$inputName];
    }

    public function updateImage(array $data, $inputName, $oldPath = null)
    {
        if ($data[$inputName]) {
            $file = storage_path('app/public/'.$oldPath);

            if ($oldPath && file_exists($file)) {
                unlink($file);
            }

            return $this->uploadImage($inputName);
        }
    }

    public function deleteImage(string $path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function generateFilePath($file, $subFolder = 'images')
    {
        $extension = $file->getClientOriginalExtension();
        $timestamp = date('YmdHis');
        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $path = "$subFolder/$year/$month/$day";
        if (! File::exists(storage_path($path))) {
            File::makeDirectory(storage_path($path), 0755, true);
        }

        return "{$path}/{$timestamp}.{$extension}";
    }
}
