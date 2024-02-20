<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpineModel extends Model
{
    use HasFactory;

    protected $table = 'spine_models';
    protected $guarded = [];

    public function parts()
    {
        //Связь многие ко многим
        return $this->belongsToMany(SpinePart::class);
    }
}
