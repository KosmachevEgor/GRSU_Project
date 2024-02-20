<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Admin\SpineModel\BaseController;
use App\Http\Requests\SpineModel\StoreRequest;
use App\Models\SpineModel;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('admin.models.index');
    }
}
