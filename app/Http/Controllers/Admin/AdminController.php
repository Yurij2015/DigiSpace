<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Ticket;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function tickets(): Response
    {
        return Inertia::render('Admin/Tickets', [
            'tickets' => Ticket::with('user:id,name')->latest()->get(),
        ]);
    }

    public function categories(): Response
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
    public function posts(): Response
    {
        $posts = Post::with('category:id,name')->latest()->get();
        $this->changeImgPathIfNullInPosts($posts);
        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function changeImgPathIfNullInPosts($posts): void
    {
        foreach ($posts as $post) {
            $this->changeImgPathIfNull($post);
        }
    }

    public function changeImgPathIfNull($post): void
    {
        if ($post->img_path === 'http://localhost/uploads' || $post->img_path === 'https://localhost/uploads') {
            $post->img_path = 'no_image.png';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function categoryStore(Request $request): Application|RedirectResponse|Redirector
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
    public function postForm(): Response
    {
        return Inertia::render('Admin/Posts/Create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Send post and categories to view, render post edit view.
     *
     * @param $post
     * @return Response
     */
    public function postUpdateForm($post): Response
    {
        $post = Post::where('id', $post)->first();
        $this->changeImgPathIfNull($post);
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
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function postUpdate(Request $request, Post $post): Redirector|RedirectResponse|Application
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
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function postSave(Request $request): Application|RedirectResponse|Redirector
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

    public function categoryShow(Category $category): Response
    {
        $posts = Post::all()->where('category_id', $category->id);
        $this->changeImgPathIfNullInPosts($posts);
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
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function categoryUpdate(Request $request, Category $category): Redirector|RedirectResponse|Application
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
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function categoryDestroy(Category $category): Redirector|RedirectResponse|Application
    {
        $this->authorize('categoryDestroy', $category);
        $category->delete();
        return redirect(route('admin.categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function postDestroy(Post $post): Redirector|RedirectResponse|Application
    {
        $this->authorize('postDestroy', $post);
        $post->delete();
        return redirect(route('admin.posts'));
    }
}
