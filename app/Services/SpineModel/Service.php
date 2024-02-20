<?php

namespace App\Services\SpineModel;

use App\Models\SpineModel;

class Service
{
    public function store(array $data){
        $spineParts = $data['spineParts'];
        unset($data['spineParts']);
        $spineModel = SpineModel::create($data);
        $spineModel->parts()->attach($spineParts);
    }
}
