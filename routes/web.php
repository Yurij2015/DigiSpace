<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingController;
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

Route::get('/', [LandingController::class, 'index']);

Route::get('about', static function () {
    return "About";
})->name('about');

Route::get('services', static function () {
    return "Services";
})->name('services');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::resource('tickets', TicketController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('categories', CategoryController::class)
    ->only(['index', 'show']);

Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', 'verified']);

Route::get('/admin/tickets/', [AdminController::class, 'tickets'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::post('admin/category-store', [AdminController::class, 'categoryStore'])
        ->name('admin.category-store');
    Route::delete('admin/category-destroy/{category}', [AdminController::class, 'categoryDestroy'])
        ->name('admin.category-destroy');
    Route::put('admin/category-update/{category}', [AdminController::class, 'categoryUpdate'])
        ->name('admin.category-update');
    Route::get('/admin/categories/', [AdminController::class, 'categories'])
        ->name('admin.categories');
    Route::get('admin/category-show/{category}', [AdminController::class, 'categoryShow'])
        ->name('admin.category-show');
});

Route::middleware('auth')->group(function () {
    Route::get('admin/post-store', [AdminController::class, 'postForm'])
        ->name('admin.post-store');
    Route::post('admin/post-store', [AdminController::class, 'postSave'])
        ->name('admin.post-store');
    Route::delete('admin/post-destroy/{post}', [AdminController::class, 'postDestroy'])
        ->name('admin.post-destroy');
    Route::put('admin/post-update/{post}', [AdminController::class, 'postUpdate'])
        ->name('admin.post-update');
    Route::get('admin/post-update/{post}', [AdminController::class, 'postUpdateForm'])
        ->name('admin.post-update');
    Route::get('/admin/posts/', [AdminController::class, 'posts'])
        ->name('admin.posts');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/widgets/', [WidgetController::class, 'index'])
        ->name('admin.widgets');
    Route::get('admin/widget-update/{widget}', [WidgetController::class, 'widgetUpdateForm'])
        ->name('admin.widget-update');
    Route::get('admin/widget-form', [WidgetController::class, 'widgetForm'])
        ->name('admin.widget-form');
    Route::post('admin/widget-save', [WidgetController::class, 'widgetSave'])
        ->name('admin.widget-save');
    Route::put('admin/widget-update/{widget}', [WidgetController::class, 'widgetUpdate'])
        ->name('admin.widget-update');
    Route::delete('admin/widget-destroy/{widget}', [WidgetController::class, 'widgetDestroy'])
        ->name('admin.widget-destroy');
});

Route::get('/admin/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.profile');
Route::get('/', [LandingController::class, 'index'])->name('landing');


require __DIR__ . '/auth.php';
