<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $posts = Post::with('category:id,name')->latest()->get();

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): Response
    {
        $post = Post::with('category:id,name')->where('id', $post->id)->get()->first();

        return Inertia::render('Posts/View', [
            'post' => $post,
        ]);
    }
}
