<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.spine-model.index');
    }
}
