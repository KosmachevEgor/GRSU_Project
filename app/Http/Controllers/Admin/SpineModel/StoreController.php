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

        if($request->hasFile('model_image_path') ) {
            $image = $request->file('model_image_path');
            $imagePath = $image->store('images', 'public');
            $data['model_image_path'] = $imagePath;

        }
        if($request->hasFile('model_path')){
            $model = $request->file('model_path');
            $modelName = $request->file('model_path')->getClientOriginalName();
            $data['model_path'] = $model->storeAs('models',$modelName, 'public');
        }

        $this->service->store($data);

        return redirect()->route('admin.models.index');
    }
}
