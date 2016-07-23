<?php

namespace App\Http\Controllers\Auth;

use Laravel\Spark\Http\Controllers\Auth\RegisterController as SparkRegisterController;

class RegisterController extends SparkRegisterController
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
}
