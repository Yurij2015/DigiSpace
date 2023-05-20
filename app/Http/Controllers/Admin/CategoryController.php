<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    final public function categories(): Response
    {
        return Inertia::render('Admin/Categories', [
            'categories' => Category::all(),
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
            'slug' => 'string|max:255',
            'description' => 'required|string|max:255'
        ]);
        $request->user()->categories()->create($validated);
        return redirect(route('admin.categories'));
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

        if (!$request->slug) {
            $category->slug = \Str::slug($request->name);
        } else {
            $category->slug = \Str::slug($request->slug);
        }

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
}
