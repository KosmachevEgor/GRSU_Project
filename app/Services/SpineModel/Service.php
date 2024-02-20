<?php

namespace App\Services\SpineModel;

use App\Models\SpineModel;

class Service
{
    public function store(array $data){
        $spineParts = $data['spine_parts'];
        unset($data['spine_parts']);
        $spineModel = SpineModel::create($data);
        $spineModel->parts()->attach($spineParts);
    }
}
