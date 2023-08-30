<?php

namespace App\Adm\Services;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class PostService
{
    public static function getListOfPostTemplates(): array
    {
        return AdmService::getViewBladeFileNames('template/posts');
    }

    public static function getPostTemplateName(string $type): string
    {
        $template = 'post-'.$type;

        $templates = self::getListOfPostTemplates();

        if(!in_array($template, $templates)) {
            $template = 'post';
        }

        if(!in_array('post', $templates)) {
            abort(404);
        }

        return $template;
    }

    public function getAll(?int $paginationCount = 10): LengthAwarePaginator
    {
        return Post::query()
            ->active()
            ->locale()
            ->with(['categories', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public function getOneBySlug($slug)
    {
        $post =  Post::query()->where('slug', $slug)
            ->active()
            ->locale()
            ->with(['categories', 'tags'])
            ->first();

        if($post) {
            $post->increment('views');
            $post->save();
        }

        return $post;
    }

    public function getAllByCategorySlug($slug, ?int $paginationCount = 10)
    {
        return Post::query()
            ->with(['categories', 'tags'])
            ->active()
            ->locale()
            ->whereHas('categories', function (Builder $query) use ($slug){
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public function getAllByTagSlug($slug, ?int $paginationCount = 10)
    {
        return Post::query()
            ->with(['categories', 'tags'])
            ->active()
            ->locale()
            ->whereHas('tags', function (Builder $query) use ($slug){
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public static function popularPosts(?int $paginationCount = 5, ?string $categorySlug = '')
    {
        $post = Post::query()->active()->locale();

        if(!empty($categorySlug)) {
            $post = $post->whereHas('categories', function (Builder $query) use ($categorySlug){
                $query->where('slug', $categorySlug);
            });
        }

        return $post->with(['categories', 'tags'])->orderBy('views', 'desc')->paginate($paginationCount);
    }

    public function searchByPhrase(string $phrase, ?int $paginationCount = 10)
    {
        return Post::query()
            ->active()
            ->locale()
            ->where('title', 'like', '%'.$phrase.'%')
            ->orWhere('content', 'like', '%'.$phrase.'%')
            ->orWhere('short', 'like', '%'.$phrase.'%')
            ->with(['categories', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }
}
