<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function __invoke()
    {
        return view('auth.register');
    }
}
