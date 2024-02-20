<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpinePart extends Model
{
    use HasFactory;

    public function models()
    {
        //Связь многие ко многим
        return $this->belongsToMany(SpineModel::class);
    }
}
