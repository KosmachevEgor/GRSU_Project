<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Requests\SpineModel\UpdateRequest;
use App\Models\SpineModel;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, string $id){

        $spineModel = SpineModel::findOrFail($id);

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

        $this->service->update($spineModel, $data);
        return redirect()->route('admin.models.show', $spineModel->id);
    }
}
