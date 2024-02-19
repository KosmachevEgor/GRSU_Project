<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpineModelPart extends Model
{
    use HasFactory;

    protected $table = 'spine_model_parts';
    protected $guarded = false;
}
