<?php

namespace App\Http\Controllers\VirtualTour;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $spineModels = SpineModel::all();
        return view('virtual-tour.index', compact('spineModels'));
    }
}
