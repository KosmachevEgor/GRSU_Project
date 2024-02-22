<?php

namespace App\Http\Controllers\Admin\SpinePart;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use App\Models\SpinePart;

class UpdateController extends Controller
{
    public function __invoke(Request $request, string $id){

        $spinePart = SpinePart::find($id);
        $spinePart->update($request->all());
        $spinePart = $spinePart->refresh();
        return redirect()->route('admin.parts.index');
    }
}
