<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $posts = Post::with('category:id,name')->latest()->get();
        $this->changeImgPathIfNullInPosts($posts);
        return Inertia::render('Posts/Index', [
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
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        $post = Post::with('category:id,name')->where('id', $post->id)->get()->first();
        $this->changeImgPathIfNull($post);
        return Inertia::render('Posts/View', [
            'post' => $post,
        ]);
    }
}
