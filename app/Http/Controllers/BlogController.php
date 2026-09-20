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

    public function index(): Response|View
    {
        $posts = Post::with('category')
            ->published()
            ->latest()
            ->paginate(config('constants.NUMBER_POSTS_IN_BLOG_PAGE'));
        if ($posts->count() === 0) {
            return response()->view('errors.page-not-found')->setStatusCode(404);
        }
        $banner = BlogPostBanner::where('blog_page_type', 'blog')->first();

        return view('blog.index', [
            'sideBarData' => $this->sideBarData(),
            'posts' => $posts,
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null,
        ]);
    }

    public function show(Request $request): View|Response
    {
        $postSlug = (string) $request->route('postSlug');
        $post = Post::where('slug', $postSlug)
            ->published()
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

    public function category(Request $request): View
    {
        $categorySlug = (string) $request->route('categorySlug');
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $posts = Post::whereBelongsTo($category)->published()
            ->latest()
            ->paginate(config('constants.NUMBER_POSTS_IN_BLOG_PAGE'));
        $banner = BlogPostBanner::where('blog_page_type', 'category')->first();

        return view('blog.index', [
            'posts' => $posts,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null,
            'category' => $category,
        ]);
    }

    public function archive(Request $request): View
    {
        $yearMonth = (string) $request->route('yearMonth');
        abort_unless(preg_match('/^\d{4}-\d{1,2}$/', $yearMonth) === 1, 404);
        [$year, $month] = explode('-', $yearMonth);
        $posts = $this->blogRepository->getArchivedPosts((int) $year, (int) $month);
        $banner = BlogPostBanner::where('blog_page_type', 'archive')->first();

        return view('blog.index', [
            'posts' => $posts,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null,
            'archive' => $yearMonth,
        ]);
    }

    public function search(Request $request): View
    {
        $posts = Post::published()->latest();
        if ($term = request('search')) {
            $posts->where(fn ($query) => $query
                ->where('name', 'like', '%'.$term.'%')
                ->orWhere('content', 'like', '%'.$term.'%'));
        }

        $posts = $posts->paginate(config('constants.NUMBER_POSTS_IN_MENU'));
        $banner = BlogPostBanner::where('blog_page_type', 'search')->first();

        return view('blog.index', [
            'sideBarData' => $this->sideBarData(),
            'posts' => $posts,
            'postsNumber' => $this->getPostsNumber(),
            'banner' => $banner ?: null,
        ]);
    }

    private function sideBarData(): array
    {
        return [
            'categories' => $this->getCategories(),
            'latestPosts' => $this->getLatestPosts(3),
            'archive' => $this->blogRepository->getGroupedPosts(),
        ];
    }

    private function getCategories(): Collection
    {
        return Category::orderByDesc('created_at')
            ->withWhereHas('post', fn ($q) => $q->published())
            ->get();
    }

    private function getPostsNumber(): int
    {
        return Post::published()->count();
    }

    private function getLatestPosts(int $count): Collection
    {
        return Post::published()
            ->latest()
            ->with('category')
            ->take($count)
            ->get();
    }
}
