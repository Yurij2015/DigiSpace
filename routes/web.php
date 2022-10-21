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

Route::get('/', function () {
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

//Route::resource('/admin/tickets/', AdminController::class)
//    ->only(['index'])
//    ->middleware(['auth', 'verified']);

//Route::get('/admin/tickets/', [AdminController::class, 'index']);
Route::get('/admin/tickets/', [AdminController::class, 'tickets'])->middleware(['auth', 'verified']);

//Route::resource('/admin/categories/', AdminController::class)
//    ->only(['categories'])
//    ->middleware(['auth', 'verified']);

//Route::get('/admin/categories/', [AdminController::class, 'categories'])->middleware(['auth']);

//Route::get('/admin/category-store/', [AdminController::class, 'categoryStore'])->middleware(['auth', 'verified']);
//Route::post('/admin/category-store/', [AdminController::class, 'categoryStore'])->middleware(['auth', 'verified']);

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

//Route::resource('admin/category-store', AdminController::class)
//    ->only(['store'])
//    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
