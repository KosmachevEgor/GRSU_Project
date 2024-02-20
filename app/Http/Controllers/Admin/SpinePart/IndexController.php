<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;
use App\Models\SpinePart;

class IndexController extends Controller
{
    public function __invoke()
    {
        $parts = SpinePart::all();
        return view('admin.spine_part.index', compact('parts'));
    }
}
