<?php

namespace App\Http\Controllers\Admin\SpinePart;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpinePart\StoreRequest;
use App\Models\SpinePart;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        SpinePart::create($data);

        return redirect()->route('admin.parts.index');
    }
}
