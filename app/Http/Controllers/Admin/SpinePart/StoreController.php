<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;
use App\Models\SpinePart;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        SpinePart::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.parts.index');
    }
}
