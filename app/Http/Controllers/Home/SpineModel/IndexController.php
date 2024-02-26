<?php

namespace App\Http\Controllers\Home\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $spineModels = SpineModel::all();
        return view('home.spine_models.index', compact('spineModels'));
    }
}
