<?php

namespace App\Http\Controllers;

use App\Adm\Services\CategoryService;
use App\Adm\Services\PostService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public CategoryService $categoryService;
    public PostService $postService;
    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService::getAllParents();

        return view('template.categories', compact('categories'));
    }

    public function show(Request $request, $slug)
    {
        $category = $this->categoryService->getOneBySlug($slug);

        $posts = $this->postService->getAllByCategorySlug($slug, globalPaginationCount());

        return view('template.category', compact('category', 'posts'));
    }
}
