<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Repository\BlogRepository;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class BlogController extends Controller
{
    private BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(): View
    {
        $posts = Post::paginate(config('constants.NUMBER_POSTS_IN_MENU'));
        return view('blog.index', [
            'sideBarData' => $this->sideBarData(),
            'posts' => $posts,
            'postsNumber' => $this->getPostsNumber()
        ]);
    }

    public function show(string $postSlug): View
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();
        return view('blog.post_show', [
            'post' => $post,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber()
        ]);
    }

    public function category(string $categorySlug): View
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->paginate(10);
        return view('blog.index', [
            'posts' => $posts,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber()
        ]);
    }

    public function archive(string $yearMonth): View
    {
        $explodedYearsMonth = explode('-', $yearMonth);
        [$year, $month] = $explodedYearsMonth;
        $posts = $this->blogRepository->getArchivedPosts($year, $month);
        return view('blog.index', [
            'posts' => $posts,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber()
        ]);
    }

    private function sideBarData(): array
    {
        return [
            'categories' => $this->getCategories(),
            'latestPosts' => $this->getLatestPosts(),
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

    private function getLatestPosts(): Collection
    {
        return Post::orderBy('created_at', 'DESC')->get()->take(3);
    }
}
