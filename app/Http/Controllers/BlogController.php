<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class BlogController extends Controller
{
    public function index(): Application|Factory|View
    {
        $posts = Post::paginate(config('constants.NUMBER_POSTS_IN_MENU'));
        return view('blog.index', [
            'sideBarData' => $this->sideBarData(),
            'posts' => $posts,
            'postsNumber' => $this->getPostsNumber()
        ]);
    }

    public function show(string $postSlug): Factory|View|Application
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();
        return view('blog.post_show', [
            'post' => $post,
            'sideBarData' => $this->sideBarData(),
            'postsNumber' => $this->getPostsNumber()
        ]);
    }

    public function category(string $categorySlug): Factory|View|Application
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->paginate(10);
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
            'archive' => [
                ['id' => 1, 'url' => 'august-2022', 'monthYear' => 'August 2022'],
                ['id' => 2, 'url' => 'july-2022', 'monthYear' => 'July 2022'],
                ['id' => 3, 'url' => 'june-2022', 'monthYear' => 'June 2022'],
                ['id' => 4, 'url' => 'may-2022', 'monthYear' => 'May 2022'],
                ['id' => 5, 'url' => 'april-2022', 'monthYear' => 'April 2022'],
                ['id' => 6, 'url' => 'march-2022', 'monthYear' => 'March 2022']
            ]
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
