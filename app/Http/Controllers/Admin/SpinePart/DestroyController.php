<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;
use App\Models\SpinePart;

class DestroyController extends Controller
{
    public function __invoke(string $id){
        SpinePart::destroy($id);
        return redirect()->route('admin.parts.index');
    }
}
