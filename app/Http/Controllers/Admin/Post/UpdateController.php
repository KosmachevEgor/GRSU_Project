<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Admin\Post\BaseController;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, string $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validated();

        $this->service->update($post, $data);

        return redirect()->route('admin.posts.index');
    }
}
