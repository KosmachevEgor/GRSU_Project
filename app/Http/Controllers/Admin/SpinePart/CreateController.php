<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('admin.spine_part.create');
    }
}
