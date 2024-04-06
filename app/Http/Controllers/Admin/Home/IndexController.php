<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SpineModel;
use App\Models\SpinePart;
class IndexController extends Controller
{
    public function __invoke()
    {
        $countOfPosts = Post::all()->count();
        $countOfModels = SpineModel::all()->count();
        $countOfParts = SpinePart::all()->count();

        return view('admin.home.index', compact('countOfPosts', 'countOfModels', 'countOfParts'));
    }
}
