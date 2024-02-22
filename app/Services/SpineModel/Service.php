<?php

namespace App\Services\SpineModel;

use App\Models\SpineModel;

class Service
{
    public function update(SpineModel $spineModel,array $data){
        $imagePath = $data['model_image_path'] ?? null;
        unset($data['model_image_path']);

        $modelPath = $data['model_path'] ?? null;
        unset($data['model_path']);

        $spineParts = $data['spine_parts'];
        unset($data['spine_parts']);

        $spineModel->update($data);
        $spineModel = $spineModel->refresh();
        $spineModel->parts()->sync($spineParts);
    }
    public function store(array $data){
        $imagePath = $data['model_image_path'] ?? null;
        unset($data['model_image_path']);

        $modelPath = $data['model_path'] ?? null;
        unset($data['model_path']);

        $spineParts = $data['spine_parts'];
        unset($data['spine_parts']);

        $spineModel = SpineModel::create($data);
        $spineModel->update(['model_image_path' => $imagePath]);
        $spineModel->update(['model_path' => $modelPath]);
        $spineModel->parts()->attach($spineParts);
    }
}
