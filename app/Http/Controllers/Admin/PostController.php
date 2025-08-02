<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Get and change array with posts
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
     * Send categories to view, render post create view.
     */
    final public function postForm(): Response
    {
        return Inertia::render('Admin/Posts/Create', [
            'categories' => Category::all(),
            'api_key_tinymce' => config('app.tiny_mce_api_key'),
        ]);
    }

    /**
     * Send post and categories to view, render post edit view.
     */
    final public function postUpdateForm($post, PostService $postService): Response
    {
        $post = Post::where('id', $post)->first();
        $postService->changeImgPathIfNull($post);

        return Inertia::render('Admin/Posts/Update', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @throws AuthorizationException
     */
    final public function postUpdate(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('postUpdate', $post);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'string',
            'category_id' => 'int',
            'file' => '',
        ]);

        if ($request->file) {
            $fileName = $this->storeImageOnMinio($request);

            $post->img_path = $fileName;
        }

        $post->slug = \Str::slug($request->name);

        $post->update($validated);

        return redirect(route('admin.posts'));
    }

    /**
     * Save a newly created post in storage.
     */
    final public function postSave(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'string',
            'category_id' => 'int',
            'file' => 'required',
        ])->validate();

        $fileName = $this->storeImageOnMinio($request);

        Post::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'content' => $request['content'],
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
            'img_path' => $fileName,
        ]);

        return redirect(route('admin.posts'))->with('message', 'Post Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @throws AuthorizationException
     */
    final public function postDestroy(Post $post): RedirectResponse
    {
        $this->authorize('postDestroy', $post);
        $post->delete();

        return redirect(route('admin.posts'));
    }

    private function storeImageOnMinio(Request $request): string
    {
        $fileName = null;
        $user = auth()->user();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $filePath = rtrim('posts/'.$user->id, '/').'/'.ltrim($imageName, '/');
            Storage::disk('s3')->put($filePath, file_get_contents($image));
            $fileName = Storage::disk('s3')->url($filePath);
            //            $user->save();
        }

        return $fileName;
    }
}
