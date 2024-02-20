<?php

namespace App\Http\Controllers\Admin\SpineModel;

use App\Http\Controllers\Controller;
use App\Services\SpineModel\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(
        Service $service
    ) {
        $this->service = $service;
    }

}
