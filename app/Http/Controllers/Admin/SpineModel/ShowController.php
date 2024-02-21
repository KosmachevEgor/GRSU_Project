<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(string $id): View
    {
        return view('admin.spine_model.show', [
            'spineModel'=>SpineModel::findOrFail($id)
        ]);
    }
}
