<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        $posts = Post::all()->where('category_id', $category->id);

        return Inertia::render('Categories/View', [
            'category' => $category,
            'posts' => $posts
        ]);
    }
}
