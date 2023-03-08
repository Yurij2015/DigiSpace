<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{

    public function index(): Response
    {
        $ordersPerMonth = [
            [30, 78, 56, 34, 100, 45, 13],
            [27, 68, 86, 74, 10, 4, 87]
        ];
        return Inertia::render('Admin/Index', [
            'ordersPerMonth' => $ordersPerMonth,
            'profileImg' => "/img/team-2-800x800.jpg"
        ]);
    }

    final public function categories(): Response
    {
        return Inertia::render('Admin/Categories', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Get and change array with posts
     *
     * @return Response
     */
    final public function posts(PostService $postService): Response
    {
        $posts = Post::with('category:id,name')->latest()->get();
        $postService->changeImgPathIfNullInPosts($posts);
        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    final public function categoryStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);
        $request->user()->categories()->create($validated);
        return redirect(route('admin.categories'));
    }

    /**
     * Send categories to view, render post create view.
     *
     * @return Response
     */
    final public function postForm(): Response
    {
        return Inertia::render('Admin/Posts/Create', [
            'categories' => Category::all(),
            'api_key_tinymce' => env('TINY_MCE_API_KEY')
        ]);
    }

    /**
     * Send post and categories to view, render post edit view.
     *
     * @param $post
     * @return Response
     */
    final public function postUpdateForm($post, PostService $postService): Response
    {
        $post = Post::where('id', $post)->first();
        $postService->changeImgPathIfNull($post);
        return Inertia::render('Admin/Posts/Update', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    final public function postUpdate(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('postUpdate', $post);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'category_id' => 'int',
            'file' => '',
        ]);
        if ($request->file) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads'), $fileName);
            $post->img_path = $fileName;
        }
        $post->update($validated);
        return redirect(route('admin.posts'));
    }

    /**
     * Save a newly created post in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    final public function postSave(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'category_id' => 'int',
            'file' => 'required',
        ])->validate();

        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);

        Post::create([
            'name' => $request->name,
            'content' => $request['content'],
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
            'img_path' => $fileName
        ]);
        return redirect(route('admin.posts'))->with('message', 'Post Created Successfully');
    }

    final public function categoryShow(Category $category, PostService $postService): Response
    {
        $posts = Post::all()->where('category_id', $category->id);
        $postService->changeImgPathIfNullInPosts($posts);
        return Inertia::render('Admin/Categories/CategoryView', [
            'category' => $category,
            'posts' => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    final public function categoryUpdate(Request $request, Category $category): RedirectResponse
    {
        $this->authorize('categoryUpdate', $category);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $category->update($validated);

        return redirect(route('admin.categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    final public function categoryDestroy(Category $category): RedirectResponse
    {
        $this->authorize('categoryDestroy', $category);
        $category->delete();
        return redirect(route('admin.categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    final public function postDestroy(Post $post): RedirectResponse
    {
        $this->authorize('postDestroy', $post);
        $post->delete();
        return redirect(route('admin.posts'));
    }
}
