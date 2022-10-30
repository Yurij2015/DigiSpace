<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', static function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('tickets', TicketController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('categories', CategoryController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('posts', PostController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/admin', static function () {
    return Inertia::render('Admin/Index');
})->middleware(['auth', 'verified'])->name('admin');

Route::get('/admin/tickets/', [AdminController::class, 'tickets'])->middleware(['auth', 'verified']);

Route::post('admin/category-store', [AdminController::class, 'categoryStore'])
    ->name('admin.category-store')
    ->middleware('auth');

Route::delete('admin/category-destroy/{category}', [AdminController::class, 'categoryDestroy'])
    ->name('admin.category-destroy')
    ->middleware('auth');

Route::put('admin/category-update/{category}', [AdminController::class, 'categoryUpdate'])
    ->name('admin.category-update')
    ->middleware('auth');

Route::get('/admin/categories/', [AdminController::class, 'categories'])
    ->name('admin.categories')
    ->middleware('auth');

Route::get('admin/post-store', [AdminController::class, 'postForm'])
    ->name('admin.post-store')
    ->middleware('auth');

Route::post('admin/post-store', [AdminController::class, 'postSave'])
    ->name('admin.post-store')
    ->middleware('auth');

Route::delete('admin/post-destroy/{post}', [AdminController::class, 'postDestroy'])
    ->name('admin.post-destroy')
    ->middleware('auth');

Route::put('admin/post-update/{post}', [AdminController::class, 'postUpdate'])
    ->name('admin.post-update')
    ->middleware('auth');

Route::get('admin/post-update/{post}', [AdminController::class, 'postUpdateForm'])
    ->name('admin.post-update')
    ->middleware('auth');

Route::get('/admin/posts/', [AdminController::class, 'posts'])
    ->name('admin.posts')
    ->middleware('auth');

require __DIR__ . '/auth.php';
