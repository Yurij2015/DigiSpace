<?php

namespace App\Http\Controllers;

use App\Models\BlogPostBanner;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\BlogRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogController extends Controller
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(): Response | View
    {
        $posts = Post::with('category')
            ->paginate(config('constants.NUMBER_POSTS_IN_BLOG_PAGE'));
        if ($posts->count() === 0) {
            return response()->view('errors.page-not-found')->setStatusCode(404);
        }
        $banner = BlogPostBanner::where('blog_page_type', 'blog')->first();
        return view('blog.index', [
            'sideBarData' => $this->sideBarData(),
            'posts' => $posts,
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null
        ]);
    }

    public function show(string $postSlug): View | Response
    {
        $post = Post::where('slug', $postSlug)
            ->with('blogPostBanner')
            ->with('category')
            ->first();
        if ($post === null) {
            return response()->view('errors.page-not-found')->setStatusCode(404);
        }
        return view('blog.post_show', [
            'post' => $post,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $post->blogPostBanner ?: null,
            'recentPosts' => $this->getLatestPosts(2),
        ]);
    }

    public function category(string $categorySlug): View
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)
            ->paginate(config('constants.NUMBER_POSTS_IN_BLOG_PAGE'));
        $banner = BlogPostBanner::where('blog_page_type', 'category')->first();
        return view('blog.index', [
            'posts' => $posts,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null,
            'category' => $category
        ]);
    }

    public function archive(string $yearMonth): View
    {
        $explodedYearsMonth = explode('-', $yearMonth);
        [$year, $month] = $explodedYearsMonth;
        $posts = $this->blogRepository->getArchivedPosts($year, $month);
        $banner = BlogPostBanner::where('blog_page_type', 'archive')->first();
        return view('blog.index', [
            'posts' => $posts,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null,
            'archive' => $yearMonth
        ]);
    }

    public function search(Request $request): View
    {
        $posts = Post::query();
        if (request('search')) {
            $posts
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('content', 'like', '%' . request('search') . '%');
        }

        $posts = $posts->paginate(config('constants.NUMBER_POSTS_IN_MENU'));
        $banner = BlogPostBanner::where('blog_page_type', 'search')->first();
        return view('blog.index', [
            'sideBarData' => $this->sideBarData(),
            'posts' => $posts,
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null
        ]);
    }

    private function sideBarData(): array
    {
        return [
            'categories' => $this->getCategories(),
            'latestPosts' => $this->getLatestPosts(3),
            'archive' => $this->blogRepository->getGroupedPosts()
        ];
    }

    private function getCategories(): Collection
    {
        return Category::orderBy('created_at', 'DESC')->with('post')->get();
    }

    private function getPostsNumber(): int
    {
        return Post::count();
    }

    private function getLatestPosts(int $count): Collection
    {
        return Post::orderBy('created_at', 'DESC')->with('category')->get()->take($count);
    }
}
