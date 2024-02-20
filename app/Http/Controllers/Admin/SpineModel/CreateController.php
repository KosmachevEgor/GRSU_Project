<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpinePart;

class CreateController extends Controller
{
    public function __invoke()
    {
        $spineParts = SpinePart::all();
        return view('admin.spine_model.create', compact('spineParts'));
    }
}
