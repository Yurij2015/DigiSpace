# Legacy admin route inventory

Generated from `php artisan route:list --json` on 2026-09-14. This inventory covers the Inertia/Vue `/admin` and `/portfolio` compatibility surface; `/control` is intentionally excluded.

| Method | URI | Name | Action | Middleware |
|---|---|---|---|---|
| GET|HEAD | admin | admin | App\Http\Controllers\Admin\AdminController@index | web, App\Http\Middleware\Authenticate, Illuminate\Auth\Middleware\EnsureEmailIsVerified |
| GET|HEAD | admin/banner-update-form/{banner} | admin.banner-update-form | App\Http\Controllers\Admin\BlogPostBannerController@bannerUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/banner-update/{banner} | admin.banner-update | App\Http\Controllers\Admin\BlogPostBannerController@bannerUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/blog-banner-form | admin.blog-banner-form | App\Http\Controllers\Admin\BlogPostBannerController@blogBannerForm | web, App\Http\Middleware\Authenticate |
| POST | admin/blog-banner-save | admin.blog-banner-save | App\Http\Controllers\Admin\BlogPostBannerController@blogBannerSave | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/bottom-bar-settings | admin.bottom-bar-settings | App\Http\Controllers\Admin\FooterBottomBarContentController@index | web, App\Http\Middleware\Authenticate |
| PUT | admin/bottom-bar-settings-update/{bottomBarContent} | admin.bottom-bar-settings-update | App\Http\Controllers\Admin\FooterBottomBarContentController@update | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/categories | admin.categories | App\Http\Controllers\Admin\CategoryController@categories | web, App\Http\Middleware\Authenticate |
| DELETE | admin/category-destroy/{category} | admin.category-destroy | App\Http\Controllers\Admin\CategoryController@categoryDestroy | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/category-show/{category} | admin.category-show | App\Http\Controllers\Admin\CategoryController@categoryShow | web, App\Http\Middleware\Authenticate |
| POST | admin/category-store | admin.category-store | App\Http\Controllers\Admin\CategoryController@categoryStore | web, App\Http\Middleware\Authenticate |
| PUT | admin/category-update/{category} | admin.category-update | App\Http\Controllers\Admin\CategoryController@categoryUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/dafault-pages | admin.dafault-pages | App\Http\Controllers\Admin\DefaultPagesController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/default-pages/{page} | admin.default-pages.page | App\Http\Controllers\Admin\DefaultPagesController@show | web, App\Http\Middleware\Authenticate |
| POST | admin/page-create | admin.page-create | App\Http\Controllers\Admin\PagesController@pageCreate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/page-form | admin.page-form | App\Http\Controllers\Admin\PagesController@pageForm | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/page-update-form/{page} | admin.page-update-form | App\Http\Controllers\Admin\PagesController@pageUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/page-update/{page} | admin.page-update | App\Http\Controllers\Admin\PagesController@pageUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/pages | admin.pages | App\Http\Controllers\Admin\PagesController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/post-banner-add | admin.post-banner-add | App\Http\Controllers\Admin\BlogPostBannerController@postBannerAdd | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/post-banner-form/{post} | admin.post-banner-form | App\Http\Controllers\Admin\BlogPostBannerController@postBannerForm | web, App\Http\Middleware\Authenticate |
| POST | admin/post-banner-save/{post} | admin.post-banner-save | App\Http\Controllers\Admin\BlogPostBannerController@postBannerSave | web, App\Http\Middleware\Authenticate |
| DELETE | admin/post-destroy/{post} | admin.post-destroy | App\Http\Controllers\Admin\PostController@postDestroy | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/post-form | admin.post-form | App\Http\Controllers\Admin\PostController@postForm | web, App\Http\Middleware\Authenticate |
| POST | admin/post-store | admin.post-store | App\Http\Controllers\Admin\PostController@postSave | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/post-update-form/{post} | admin.post-update-form | App\Http\Controllers\Admin\PostController@postUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/post-update/{post} | admin.post-update | App\Http\Controllers\Admin\PostController@postUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/posts | admin.posts | App\Http\Controllers\Admin\PostController@posts | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/posts-banners | admin.posts-banners | App\Http\Controllers\Admin\BlogPostBannerController@index | web, App\Http\Middleware\Authenticate |
| DELETE | admin/product-destroy/{product} | admin.product-destroy | App\Http\Controllers\Admin\ProductController@destroy | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/product-form | admin.product-form | App\Http\Controllers\Admin\ProductController@productForm | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/product-services-style/{product} | admin.product-services-style | App\Http\Controllers\Admin\ProductController@productServicesStyle | web, App\Http\Middleware\Authenticate |
| PUT | admin/product-services-style/{product} | admin.save-product-services-style | App\Http\Controllers\Admin\ProductController@saveProductServiceStyle | web, App\Http\Middleware\Authenticate |
| POST | admin/product-store | admin.product-store | App\Http\Controllers\Admin\ProductController@productSave | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/product-update-form/{product} | admin.product-update-form | App\Http\Controllers\Admin\ProductController@productUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/product-update/{product} | admin.product-update | App\Http\Controllers\Admin\ProductController@update | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/products | admin.products | App\Http\Controllers\Admin\ProductController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/products/{product} | admin.product-show | App\Http\Controllers\Admin\ProductController@show | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/profile | admin.profile | App\Http\Controllers\Admin\ProfileController@index | web, App\Http\Middleware\Authenticate, Illuminate\Auth\Middleware\EnsureEmailIsVerified |
| GET|HEAD | admin/service-categories | admin.service-categories | App\Http\Controllers\Admin\ServiceCategoriesController@index | web, App\Http\Middleware\Authenticate |
| POST | admin/service-categories | admin.service-category-save | App\Http\Controllers\Admin\ServiceCategoriesController@store | web, App\Http\Middleware\Authenticate |
| PUT | admin/service-category-update/{serviceCategory} | admin.service-category-update | App\Http\Controllers\Admin\ServiceCategoriesController@update | web, App\Http\Middleware\Authenticate |
| DELETE | admin/service-destroy/{service} | admin.service-destroy | App\Http\Controllers\Admin\ServiceController@destroy | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/service-form | admin.service-form | App\Http\Controllers\Admin\ServiceController@serviceForm | web, App\Http\Middleware\Authenticate |
| POST | admin/service-store | admin.service-store | App\Http\Controllers\Admin\ServiceController@serviceSave | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/service-update-form/{service} | admin.service-update-form | App\Http\Controllers\Admin\ServiceController@serviceUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/service-update/{service} | admin.service-update | App\Http\Controllers\Admin\ServiceController@update | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/services | admin.services | App\Http\Controllers\Admin\ServiceController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/services/{service} | admin.service-show | App\Http\Controllers\Admin\ServiceController@show | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/top-bar-settings | admin.top-bar-settings | App\Http\Controllers\Admin\HeaderNavBarContentController@index | web, App\Http\Middleware\Authenticate |
| PUT | admin/top-bar-settings-update/{headerNavBarContent} | admin.top-bar-settings-update | App\Http\Controllers\Admin\HeaderNavBarContentController@update | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/top-menu | admin.top-menu | App\Http\Controllers\Admin\HeaderTopMenuController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/top-menu-edit-form/{menuItem} | admin.top-menu-edit-form | App\Http\Controllers\Admin\HeaderTopMenuController@editForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/top-menu-update/{menu} | admin.top-menu-update | App\Http\Controllers\Admin\HeaderTopMenuController@update | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/top-sub-menu-edit-form/{subMenuItem} | admin.top-sub-menu-edit-form | App\Http\Controllers\Admin\HeaderTopMenuController@subMenuEditForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/top-sub-menu-update/{subMenu} | admin.top-sub-menu-update | App\Http\Controllers\Admin\HeaderTopMenuController@subMenuUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/useful-link-list | admin.useful-link-list | App\Http\Controllers\Admin\FooterUsefulLinkController@index | web, App\Http\Middleware\Authenticate |
| POST | admin/useful-link-store | admin.useful-link-store | App\Http\Controllers\Admin\FooterUsefulLinkController@linkStore | web, App\Http\Middleware\Authenticate |
| PUT | admin/useful-link-update/{usefulLink} | admin.useful-link-update | App\Http\Controllers\Admin\FooterUsefulLinkController@linkUpdate | web, App\Http\Middleware\Authenticate |
| DELETE | admin/widget-destroy/{widget} | admin.widget-destroy | App\Http\Controllers\Admin\WidgetController@widgetDestroy | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/widget-form | admin.widget-form | App\Http\Controllers\Admin\WidgetController@widgetForm | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/widget-icon-update-form/{widgetIcon} | admin.widget-icon-update-form | App\Http\Controllers\Admin\WidgetIconController@widgetIconUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/widget-icon-update/{widgetIcon} | admin.widget-icon-update | App\Http\Controllers\Admin\WidgetIconController@widgetIconUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/widget-icons/{widget} | admin.widget-icons | App\Http\Controllers\Admin\WidgetIconController@widgetIcons | web, App\Http\Middleware\Authenticate |
| POST | admin/widget-save | admin.widget-save | App\Http\Controllers\Admin\WidgetController@widgetSave | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/widget-update-form/{widget} | admin.widget-update-form | App\Http\Controllers\Admin\WidgetController@widgetUpdateForm | web, App\Http\Middleware\Authenticate |
| PUT | admin/widget-update/{widget} | admin.widget-update | App\Http\Controllers\Admin\WidgetController@widgetUpdate | web, App\Http\Middleware\Authenticate |
| GET|HEAD | admin/widgets | admin.widgets | App\Http\Controllers\Admin\WidgetController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/add-skill | portfolio.add-skill | App\Http\Controllers\Admin\Portfolio\SkillsController@addSkill | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/add-skill-locale | portfolio.add-skill-locale | App\Http\Controllers\Admin\Portfolio\SkillsController@addSkillLocale | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/add-skill-subcategory | portfolio.add-skill-subcategory | App\Http\Controllers\Admin\Portfolio\SkillsController@addSkillSubcategory | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/add-skill-type | portfolio.add-skill-type | App\Http\Controllers\Admin\Portfolio\SkillsController@addSkillType | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/edu-item-edit/{eduItem} | portfolio.edu-item-edit | App\Http\Controllers\Admin\Portfolio\EducationController@edit | web, App\Http\Middleware\Authenticate |
| PUT | portfolio/edu-item-update/{eduItem} | portfolio.edu-item-update | App\Http\Controllers\Admin\Portfolio\EducationController@update | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/education | portfolio.education | App\Http\Controllers\Admin\Portfolio\EducationController@index | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/education-item-create | portfolio.education-item-create | App\Http\Controllers\Admin\Portfolio\EducationController@create | web, App\Http\Middleware\Authenticate |
| POST | portfolio/education-item-store | portfolio.education-item-store | App\Http\Controllers\Admin\Portfolio\EducationController@store | web, App\Http\Middleware\Authenticate |
| POST | portfolio/place-store | portfolio.place-store | App\Http\Controllers\Admin\Portfolio\SectionController@placeStore | web, App\Http\Middleware\Authenticate |
| POST | portfolio/section-item-store | portfolio.section-item-store | App\Http\Controllers\Admin\Portfolio\SectionController@sectionItemStore | web, App\Http\Middleware\Authenticate |
| POST | portfolio/section-store | portfolio.section-store | App\Http\Controllers\Admin\Portfolio\SectionController@store | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/sections | portfolio.sections | App\Http\Controllers\Admin\Portfolio\SectionController@index | web, App\Http\Middleware\Authenticate |
| POST | portfolio/skill-locale-store | portfolio.skill-locale-store | App\Http\Controllers\Admin\Portfolio\SkillsController@skillLocaleStore | web, App\Http\Middleware\Authenticate |
| POST | portfolio/skill-store | portfolio.skill-store | App\Http\Controllers\Admin\Portfolio\SkillsController@skillStore | web, App\Http\Middleware\Authenticate |
| POST | portfolio/skill-subcategory-store | portfolio.skill-subcategory-store | App\Http\Controllers\Admin\Portfolio\SkillsController@skillSubcategoryStore | web, App\Http\Middleware\Authenticate |
| POST | portfolio/skill-type-store | portfolio.skill-type-store | App\Http\Controllers\Admin\Portfolio\SkillsController@skillTypeStore | web, App\Http\Middleware\Authenticate |
| GET|HEAD | portfolio/skills | portfolio.skills | App\Http\Controllers\Admin\Portfolio\SkillsController@index | web, App\Http\Middleware\Authenticate |
| POST | portfolio/subcategory-store | portfolio.subcategory-store | App\Http\Controllers\Admin\Portfolio\SectionController@subcategoryStore | web, App\Http\Middleware\Authenticate |

Route count: **87**. Every row must have a corresponding navigation or intentional non-navigation workflow and a browser/feature check before the change is complete.

## Baseline smoke results

- `GET /en` → `200`
- `GET /uk` → `200`
- `GET /pl` → `200`
- `GET /admin` unauthenticated → `302` to authentication
- `GET /control` unauthenticated → `302` to authentication
- `vendor/bin/phpunit` → 63 tests, 579 assertions, 1 PHPUnit deprecation; all tests pass
