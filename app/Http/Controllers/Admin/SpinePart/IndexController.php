<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.spine_part.index');
    }
}
