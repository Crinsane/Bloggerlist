<?php

namespace App\Http\Controllers\Auth;

use Laravel\Spark\Http\Controllers\Auth\LoginController as SparkLoginController;

class LoginController extends SparkLoginController
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
}
