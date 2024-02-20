<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use App\Models\SpinePart;

class IndexController extends Controller
{
    public function __invoke()
    {
        $spineModels = SpineModel::all();
        $spineParts = SpinePart::all();
        return view('admin.spine_model.index', compact('spineModels','spineParts'));
    }
}
