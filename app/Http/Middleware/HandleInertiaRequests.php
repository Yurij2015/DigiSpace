<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return mixed[]
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'locale' => app()->getLocale(),
            'locales' => config('locales.supported'),
            'adminStats' => fn (): array => ($request->user() && ($request->is('admin*') || $request->is('portfolio*')))
                ? [
                    'categories' => Category::count(),
                    'pages' => Page::count(),
                    'posts' => Post::count(),
                    'services' => Service::count(),
                    'products' => Product::count(),
                ]
                : [],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => session('message'),
            ],
        ]);
    }
}
