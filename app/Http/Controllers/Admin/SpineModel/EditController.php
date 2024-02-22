<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use App\Models\SpinePart;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(string $id)
    {
        $spineModel = SpineModel::findOrFail($id);
        $spineParts = SpinePart::all();
        return view('admin.spine_model.edit', compact("spineModel","spineParts"));
    }
}
