<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'model_image_path' => 'required',
            'model_path' => 'required'
        ]);

        SpineModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'model_image_path' => $request->model_image_path,
            'model_path' => $request->model_path
        ]);

        return redirect()->route('admin.models.index');
    }
}
