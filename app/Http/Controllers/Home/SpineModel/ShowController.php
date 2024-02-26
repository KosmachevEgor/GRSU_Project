<?php

namespace App\Http\Controllers\Home\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(string $id)
    {
        $spineModel = SpineModel::find($id);
        return view('home.spine_models.show', compact('spineModel'));
    }
}
