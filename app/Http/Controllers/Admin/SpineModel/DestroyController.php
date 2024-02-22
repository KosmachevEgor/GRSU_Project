<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;
use App\Models\SpineModel;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(string $id){
        SpineModel::destroy($id);
        return redirect()->route('admin.models.index');
    }
}
