<?php

namespace App\Models;

use App\Events\SpineModelDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpineModel extends Model
{
    use HasFactory;

    protected $table = 'spine_models';
    protected $guarded = [];

    protected $dispatchesEvents = [
        'deleted' => SpineModelDeleted::class
    ];

    public function parts()
    {
        //Связь многие ко многим
        return $this->belongsToMany(SpinePart::class);
    }
}
