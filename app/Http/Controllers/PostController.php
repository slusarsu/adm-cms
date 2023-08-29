<?php

namespace App\Http\Controllers;

use App\Adm\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function show(Request $request, $slug)
    {
        $post = $this->postService->getOneBySlug($slug);

        if(!$post) {
            return redirect('/');
        }

        $thumb = $post->thumb();
        $images = $post->images();
        $postType = $post->type ?? 'text';
        $postTemplate = PostService::getPostTemplateName($postType);

        return view('template.posts.'.$postTemplate, compact('post', 'thumb', 'images'));
    }
}
