<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogPostBannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DefaultPagesController;
use App\Http\Controllers\Admin\FooterBottomBarContentController;
use App\Http\Controllers\Admin\FooterUsefulLinkController;
use App\Http\Controllers\Admin\HeaderNavBarContentController;
use App\Http\Controllers\Admin\HeaderTopMenuController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\Portfolio\EducationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\WidgetIconController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FooterPagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ServiceController;
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

Route::controller(BlogController::class)->group(function () {
    Route::get('blog', 'index')->name('blog');
    Route::get('blog-category/{categorySlug}', 'category')->name('blog-category');
    Route::get('blog-archive/{yearMonth}', 'archive')->name('blog-archive');
    Route::get('blog-search', 'search')->name('blog-search');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('contact-us', 'index')->name('contact-us');
    Route::post('contact-us', 'save')->name('contact.save');
});

Route::post('subscriber-save', [SubscriberController::class, 'save'])->name('subscriber-save');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(['auth', 'verified']);

Route::controller(CategoryController::class)->middleware('auth')->group(function () {
    Route::post('admin/category-store', 'categoryStore')->name('admin.category-store');
    Route::delete('admin/category-destroy/{category}', 'categoryDestroy')->name('admin.category-destroy');
    Route::put('admin/category-update/{category}', 'categoryUpdate')->name('admin.category-update');
    Route::get('/admin/categories/', 'categories')->name('admin.categories');
    Route::get('admin/category-show/{category}', 'categoryShow')->name('admin.category-show');
});

Route::controller(PostController::class)->middleware('auth')->group(function () {
    Route::get('admin/post-store', 'postForm')->name('admin.post-store');
    Route::post('admin/post-store', 'postSave')->name('admin.post-store');
    Route::delete('admin/post-destroy/{post}', 'postDestroy')->name('admin.post-destroy');
    Route::put('admin/post-update/{post}', 'postUpdate')->name('admin.post-update');
    Route::get('admin/post-update/{post}', 'postUpdateForm')->name('admin.post-update');
    Route::get('/admin/posts/', 'posts')->name('admin.posts');
});

Route::controller(WidgetController::class)->middleware('auth')->group(function () {
    Route::get('/admin/widgets/', 'index')->name('admin.widgets');
    Route::get('admin/widget-update/{widget}', 'widgetUpdateForm')->name('admin.widget-update');
    Route::get('admin/widget-form', 'widgetForm')->name('admin.widget-form');
    Route::post('admin/widget-save', 'widgetSave')->name('admin.widget-save');
    Route::put('admin/widget-update/{widget}', 'widgetUpdate')->name('admin.widget-update');
    Route::delete('admin/widget-destroy/{widget}', 'widgetDestroy')->name('admin.widget-destroy');
});

Route::controller(WidgetIconController::class)->middleware('auth')->group(function () {
    Route::get('admin/widget-icons/{widget}', 'widgetIcons')->name('admin.widget-icons');
    Route::get('admin/widget-icon-update-form/{widgetIcon}', 'widgetIconUpdateForm')
        ->name('admin.widget-icon-update-form');
    Route::put('admin/widget-icon-update/{widgetIcon}', 'widgetIconUpdate')->name('admin.widget-icon-update');
});

Route::controller(DefaultPagesController::class)->middleware('auth')->group(function () {
    Route::get('/admin/dafault-pages', 'index')->name('admin.dafault-pages');
    Route::get('/admin/default-pages/{page}', 'show')->name('admin.default-pages.page');
});

Route::controller(PagesController::class)->middleware('auth')->group(function () {
    Route::get('/admin/pages', 'index')->name('admin.pages');
    Route::get('admin/page-form', 'pageForm')->name('admin.page-form');
    Route::post('admin/page-create', 'pageCreate')->name('admin.page-create');
    Route::get('admin/page-update-form/{page}', 'pageUpdateForm')->name('admin.page-update-form');
    Route::put('admin/page-update/{page}', 'pageUpdate')->name('admin.page-update');
});

Route::controller(AdminServiceController::class)->middleware('auth')->group(function () {
    Route::get('/admin/services', 'index')->name('admin.services');
    Route::get('admin/service-form', 'serviceForm')->name('admin.service-form');
    Route::post('admin/service-store', 'serviceSave')->name('admin.service-store');
    Route::get('/admin/services/{service}', 'show')->name('admin.service-show');
    Route::get('admin/service-update/{service}', 'serviceUpdateForm')->name('admin.service-update');
    Route::put('admin/service-update/{service}', 'update')->name('admin.service-update');
    Route::delete('admin/service-destroy/{service}', 'destroy')->name('admin.service-destroy');
});

Route::controller(AdminProductController::class)->middleware('auth')->group(function () {
    Route::get('/admin/products', 'index')->name('admin.products');
    Route::get('admin/product-form', 'productForm')->name('admin.product-form');
    Route::post('admin/product-store', 'productSave')->name('admin.product-store');
    Route::get('admin/product-update/{product}', 'productUpdateForm')->name('admin.product-update');
    Route::get('/admin/products/{product}', 'show')->name('admin.product-show');
    Route::put('admin/product-update/{product}', 'update')->name('admin.product-update');
    Route::delete('admin/product-destroy/{product}', 'destroy')->name('admin.product-destroy');
});

Route::controller(FooterUsefulLinkController::class)->middleware('auth')->group(function () {
    Route::get('/admin/useful-link-list/', 'index')->name('admin.useful-link-list');
    Route::post('admin/useful-link-store', 'linkStore')->name('admin.useful-link-store');
    Route::put('admin/useful-link-update/{usefulLink}', 'linkUpdate')->name('admin.useful-link-update');
});

Route::controller(HeaderNavBarContentController::class)->middleware('auth')->group(function () {
    Route::get('/admin/top-bar-settings/', 'index')->name('admin.top-bar-settings');
    Route::put('admin/top-bar-settings-update/{headerNavBarContent}', 'update')->name('admin.top-bar-settings-update');
});

Route::controller(FooterBottomBarContentController::class)->middleware('auth')->group(function () {
    Route::get('/admin/bottom-bar-settings/', 'index')->name('admin.bottom-bar-settings');
    Route::put('admin/bottom-bar-settings-update/{bottomBarContent}', 'update')
        ->name('admin.bottom-bar-settings-update');
});

Route::controller(HeaderTopMenuController::class)->middleware('auth')->group(function () {
    Route::get('/admin/top-menu/', 'index')->name('admin.top-menu');
    Route::get('/admin/top-menu-edit-form/{menuItem}', 'editForm')->name('admin.top-menu-edit-form');
    Route::put('admin/top-menu-update/{menu}', 'update')->name('admin.top-menu-update');
    Route::get('/admin/top-sub-menu-edit-form/{subMenuItem}', 'subMenuEditForm')->name('admin.top-sub-menu-edit-form');
    Route::put('admin/top-sub-menu-update/{subMenu}', 'subMenuUpdate')->name('admin.top-sub-menu-update');
});

Route::controller(BlogPostBannerController::class)->middleware('auth')->group(function () {
    Route::get('admin/posts-banners', 'index')->name('admin.posts-banners');
    Route::get('admin/post-banner-add', 'postBannerAdd')->name('admin.post-banner-add');
    Route::get('admin/post-banner-form/{post}', 'postBannerForm')->name('admin.post-banner-form');
    Route::post('admin/post-banner-save/{post}', 'postBannerSave')->name('admin.post-banner-save');
    Route::get('admin/banner-update-form/{banner}', 'bannerUpdateForm')->name('admin.banner-update-form');
    Route::put('admin/banner-update/{banner}', 'bannerUpdate')->name('admin.banner-update');
    Route::get('admin/blog-banner-form', 'blogBannerForm')->name('admin.blog-banner-form');
    Route::post('admin/blog-banner-save', 'blogBannerSave')->name('admin.blog-banner-save');
});

Route::controller(EducationController::class)->middleware('auth')->group(function () {
    Route::get('portfolio/education', 'index')->name('portfolio.education');
    Route::get('portfolio/education-item-create', 'create')->name('portfolio.education-item-create');
    Route::post('portfolio/education-item-store', 'store')->name('portfolio.education-item-store');
    Route::get('portfolio/edu-item-edit/{eduItem}', 'edit')->name('portfolio.edu-item-edit');
    Route::put('portfolio/edu-item-update/{eduItem}', 'update')->name('portfolio.edu-item-update');
});

Route::get('/admin/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])
    ->name('admin.profile');

Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.page');
Route::get('/blog/{postSlug}', [BlogController::class, 'show'])->name('blog.post');
Route::get('/page-not-found', [NotFoundController::class, 'index'])->name('error-404');

Route::controller(FooterPagesController::class)->group(function () {
    Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('faq', 'faq')->name('faq');
    Route::get('support', 'support')->name('support');
});

require __DIR__ . '/auth.php';
