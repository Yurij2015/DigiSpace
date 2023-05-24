<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPostBanner;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class BlogPostBannerController extends Controller
{
    final public function index(): Response
    {
        return Inertia::render('Admin/BlogPostBanners/Index', [
            'blogPostBanners' => BlogPostBanner::with('post')->paginate(20)
        ]);
    }

    final public function postBannerAdd(): Response
    {
        return Inertia::render('Admin/BlogPostBanners/AddBanners', [
            'posts' => Post::with('blogPostBanner')->paginate(8),
        ]);
    }

    final public function postBannerForm(Post $post): Response
    {
        return Inertia::render('Admin/BlogPostBanners/AddBannerForm', [
            'post' => $post,
        ]);
    }

    final public function postBannerSave(Request $request, Post $post): RedirectResponse
    {
        Validator::make($request->all(), [
            'post_id' => 'int',
            'file' => 'required',
        ])->validate();

        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('banners'), $fileName);

        BlogPostBanner::create([
            'post_id' => $post->id,
            'img_path' => '/banners/' . $fileName
        ]);
        return redirect(route('admin.posts-banners'))->with('message', 'Banner Added Successfully');
    }

    final public function bannerUpdateForm(BlogPostBanner $banner): Response
    {
        $post = Post::with('blogPostBanner')->find($banner->post_id);
        return Inertia::render('Admin/BlogPostBanners/UpdateBanner', [
            'post' => $post,
        ]);
    }

    final public function bannerUpdate(Request $request, BlogPostBanner $banner): RedirectResponse
    {
        Validator::make($request->all(), [
            'file' => 'required',
        ])->validate();

        $fileName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('banners'), $fileName);

        $banner->update([
            'img_path' => '/banners/' . $fileName
        ]);
        return redirect(route('admin.posts-banners'))->with('message', 'Banner Updated Successfully');
    }
}
