<?php

use App\Http\Controllers\AdmFormController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template.index');
})->name('home');
Route::get('/switch-locale/{locale}', [TranslationController::class, 'changeLocale'])->name('switch-locale');
Route::get('/locale-switcher', [TranslationController::class, 'localeSwitcher'])->name('locale-switcher');
Route::post('/adm-form/{link_hash}', [AdmFormController::class, 'form'])->name('adm-form');
Route::get('/adm-search', [PageController::class, 'search'])->name('adm-search');
Route::get('/add-comment', [CommentController::class, 'store'])->name('add-comment');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('{slug}', [PageController::class, 'show'])->name('page');
Route::get('post/{slug}', [PostController::class, 'show'])->name('post');
Route::get('tag/{slug}', [TagController::class, 'show'])->name('tag');
Route::get('category/{slug}', [CategoryController::class, 'show'])->name('category');
