<?php

namespace App\Http\Controllers;

use App\Adm\Services\PageService;
use App\Adm\Services\PostService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private PageService $pageService;
    private PostService $postService;

    public function __construct(PageService $pageService, PostService $postService)
    {
        $this->pageService = $pageService;
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getAll(globalPaginationCount());

        return view('template.index', compact('posts'));
    }

    public function show(Request $request, $slug)
    {
        $page = $this->pageService->getOneBySlug($slug);

        if(!$page) {
            return redirect('/');
        }

        $cf = $page->customFields();
        $thumb = $page->thumb();
        $images = $page->images();
        $template = $page->template ?? 'page';
        $templateName = PageService::getPageTemplateName($template);

        return view('template.pages.'.$templateName, compact('page', 'cf', 'thumb', 'images'));
    }

    public function search(Request $request)
    {
        $phrase = $request->get('s');
        if(!$phrase) {
            return redirect('/');
        }
        $posts = $this->postService->searchByPhrase($phrase, globalPaginationCount());

        return view('template.search', compact('posts', 'phrase'));
    }
}
