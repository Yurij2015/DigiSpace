<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class PostService
{
    final public function changeImgPathIfNullInPosts($posts): void
    {
        foreach ($posts as $post) {
            $this->changeImgPathIfNull($post);
        }
    }

    final public function changeImgPathIfNull($post): void
    {
        if ($post->img_path === URL::to('/') . '/uploads') {
            $post->img_path = 'no_image.png';
        }
    }
}
