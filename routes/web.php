<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogPostBannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DefaultPagesController;
use App\Http\Controllers\Admin\FooterBottomBarContentController;
use App\Http\Controllers\Admin\FooterUsefulLinkController;
use App\Http\Controllers\Admin\HeaderNavBarContentController;
use App\Http\Controllers\Admin\HeaderTopMenuController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\WidgetIconController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FooterPagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('about', [AboutController::class, 'index'])->name('about');
Route::get('services', [ServiceController::class, 'index'])->name('services');
Route::get('pricing', [PriceController::class, 'index'])->name('pricing');
Route::get('promos', [PromoController::class, 'index'])->name('promos');
Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog-category/{categorySlug}', [BlogController::class, 'category'])->name('blog-category');
Route::get('blog-archive/{yearMonth}', [BlogController::class, 'archive'])->name('blog-archive');
Route::get('blog-search', [BlogController::class, 'search'])->name('blog-search');
Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
Route::post('contact-us', [ContactController::class, 'save'])->name('contact.save');
Route::post('subscriber-save', [SubscriberController::class, 'save'])->name('subscriber-save');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);
Route::resource('categories', CategoryController::class)
    ->only(['index', 'show']);

Route::resource('posts', PostController::class)
    ->only(['index', 'show']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::post('admin/category-store', [CategoryController::class, 'categoryStore'])
        ->name('admin.category-store');
    Route::delete('admin/category-destroy/{category}', [CategoryController::class, 'categoryDestroy'])
        ->name('admin.category-destroy');
    Route::put('admin/category-update/{category}', [CategoryController::class, 'categoryUpdate'])
        ->name('admin.category-update');
    Route::get('/admin/categories/', [CategoryController::class, 'categories'])
        ->name('admin.categories');
    Route::get('admin/category-show/{category}', [CategoryController::class, 'categoryShow'])
        ->name('admin.category-show');
});

Route::middleware('auth')->group(function () {
    Route::get('admin/post-store', [PostController::class, 'postForm'])
        ->name('admin.post-store');
    Route::post('admin/post-store', [PostController::class, 'postSave'])
        ->name('admin.post-store');
    Route::delete('admin/post-destroy/{post}', [PostController::class, 'postDestroy'])
        ->name('admin.post-destroy');
    Route::put('admin/post-update/{post}', [PostController::class, 'postUpdate'])
        ->name('admin.post-update');
    Route::get('admin/post-update/{post}', [PostController::class, 'postUpdateForm'])
        ->name('admin.post-update');
    Route::get('/admin/posts/', [PostController::class, 'posts'])
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
    Route::get('admin/widget-icons/{widget}', [WidgetIconController::class, 'widgetIcons'])
        ->name('admin.widget-icons');
    Route::get('admin/widget-icon-update-form/{widgetIcon}', [WidgetIconController::class, 'widgetIconUpdateForm'])
        ->name('admin.widget-icon-update-form');
    Route::put('admin/widget-icon-update/{widgetIcon}', [WidgetIconController::class, 'widgetIconUpdate'])
        ->name('admin.widget-icon-update');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/dafault-pages', [DefaultPagesController::class, 'index'])->name('admin.dafault-pages');
    Route::get('/admin/pages', [PagesController::class, 'index'])->name('admin.pages');
    Route::get('/admin/default-pages/{page}', [DefaultPagesController::class, 'show'])
        ->name('admin.default-pages.page');
    Route::get('admin/page-form', [PagesController::class, 'pageForm'])->name('admin.page-form');
    Route::post('admin/page-create', [PagesController::class, 'pageCreate'])->name('admin.page-create');
    Route::get('admin/page-update-form/{page}', [PagesController::class, 'pageUpdateForm'])
        ->name('admin.page-update-form');
    Route::put('admin/page-update/{page}', [PagesController::class, 'pageUpdate'])->name('admin.page-update');

    Route::get('/admin/services', [AdminServiceController::class, 'index'])->name('admin.services');
    Route::get('admin/service-form', [AdminServiceController::class, 'serviceForm'])
        ->name('admin.service-form');
    Route::post('admin/service-store', [AdminServiceController::class, 'serviceSave'])
        ->name('admin.service-store');
    Route::get('/admin/services/{service}', [AdminServiceController::class, 'show'])->name('admin.service-show');
    Route::get('admin/service-update/{service}', [AdminServiceController::class, 'serviceUpdateForm'])
        ->name('admin.service-update');
    Route::put('admin/service-update/{service}', [AdminServiceController::class, 'update'])
        ->name('admin.service-update');
    Route::delete('admin/service-destroy/{service}', [AdminServiceController::class, 'destroy'])
        ->name('admin.service-destroy');

    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('admin/product-form', [AdminProductController::class, 'productForm'])
        ->name('admin.product-form');
    Route::post('admin/product-store', [AdminProductController::class, 'productSave'])
        ->name('admin.product-store');
    Route::get('admin/product-update/{product}', [AdminProductController::class, 'productUpdateForm'])
        ->name('admin.product-update');
    Route::get('/admin/products/{product}', [AdminProductController::class, 'show'])->name('admin.product-show');
    Route::put('admin/product-update/{product}', [AdminProductController::class, 'update'])
        ->name('admin.product-update');
    Route::delete('admin/product-destroy/{product}', [AdminProductController::class, 'destroy'])
        ->name('admin.product-destroy');

    Route::get('/admin/useful-link-list/', [FooterUsefulLinkController::class, 'index'])
        ->name('admin.useful-link-list');
    Route::post('admin/useful-link-store', [FooterUsefulLinkController::class, 'linkStore'])
        ->name('admin.useful-link-store');
    Route::put('admin/useful-link-update/{usefulLink}', [FooterUsefulLinkController::class, 'linkUpdate'])
        ->name('admin.useful-link-update');

    Route::get('/admin/top-bar-settings/', [HeaderNavBarContentController::class, 'index'])
        ->name('admin.top-bar-settings');
    Route::put('admin/top-bar-settings-update/{headerNavBarContent}', [HeaderNavBarContentController::class, 'update'])
        ->name('admin.top-bar-settings-update');
    Route::get('/admin/bottom-bar-settings/', [FooterBottomBarContentController::class, 'index'])
        ->name('admin.bottom-bar-settings');
    Route::put(
        'admin/bottom-bar-settings-update/{bottomBarContent}',
        [FooterBottomBarContentController::class, 'update']
    )->name('admin.bottom-bar-settings-update');
    Route::get('/admin/top-menu/', [HeaderTopMenuController::class, 'index'])->name('admin.top-menu');
    Route::get('/admin/top-menu-edit-form/{menuItem}', [HeaderTopMenuController::class, 'editForm'])
        ->name('admin.top-menu-edit-form');
    Route::put('admin/top-menu-update/{menu}', [HeaderTopMenuController::class, 'update'])
        ->name('admin.top-menu-update');
    Route::get('/admin/top-sub-menu-edit-form/{subMenuItem}', [HeaderTopMenuController::class, 'subMenuEditForm'])
        ->name('admin.top-sub-menu-edit-form');
    Route::put('admin/top-sub-menu-update/{subMenu}', [HeaderTopMenuController::class, 'subMenuUpdate'])
        ->name('admin.top-sub-menu-update');

    Route::get('admin/posts-banners', [BlogPostBannerController::class, 'index'])
        ->name('admin.posts-banners');
    Route::get('admin/post-banner-add', [BlogPostBannerController::class, 'postBannerAdd'])
        ->name('admin.post-banner-add');
    Route::get('admin/post-banner-form/{post}', [BlogPostBannerController::class, 'postBannerForm'])
        ->name('admin.post-banner-form');
    Route::post('admin/post-banner-save/{post}', [BlogPostBannerController::class, 'postBannerSave'])
        ->name('admin.post-banner-save');
    Route::get('admin/banner-update-form/{banner}', [BlogPostBannerController::class, 'bannerUpdateForm'])
        ->name('admin.banner-update-form');
    Route::put('admin/banner-update/{banner}', [BlogPostBannerController::class, 'bannerUpdate'])
        ->name('admin.banner-update');
    Route::get('admin/blog-banner-form', [BlogPostBannerController::class, 'blogBannerForm'])
        ->name('admin.blog-banner-form');
    Route::post('admin/blog-banner-save', [BlogPostBannerController::class, 'blogBannerSave'])
        ->name('admin.blog-banner-save');
});

Route::get('/admin/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])
    ->name('admin.profile');
Route::get('/landing', static function () {
    return "Landing vue notus";
})->name('landing');

Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.page');
Route::get('/blog/{postSlug}', [BlogController::class, 'show'])->name('blog.post');
Route::get('/page-not-found', [NotFoundController::class, 'index'])->name('error-404');

Route::get('privacy-policy', [FooterPagesController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('faq', [FooterPagesController::class, 'faq'])->name('faq');
Route::get('support', [FooterPagesController::class, 'support'])->name('support');

require __DIR__ . '/auth.php';
