<?php

namespace App\Events;

use App\Models\SpineModel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpineModelDeleted
{
    use Dispatchable, SerializesModels;

    protected $spineModel;

    public function __construct(SpineModel $spineModel)
    {
        $this->spineModel = $spineModel;
    }

    public function handle()
    {
        $this->spineModel->parts()->detach();
    }
}
