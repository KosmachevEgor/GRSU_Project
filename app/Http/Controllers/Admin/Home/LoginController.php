<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __invoke()
    {
        return view('auth.login');
    }
}
