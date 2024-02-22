<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;
use App\Models\SpinePart;

class EditController extends Controller
{
    public function __invoke(string $id)
    {
        $spinePart = SpinePart::findOrFail($id);

        return view('admin.spine_part.edit', compact('spinePart'));
    }
}
