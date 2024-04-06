<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function update(Post $post, array $data)
    {
        $post->update($data);
        $post = $post->refresh();
    }

    public function store(array $data)
    {
        Post::create($data);
    }
}
