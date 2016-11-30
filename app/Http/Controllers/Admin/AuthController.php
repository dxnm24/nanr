<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\AuthController as Controller;
use App\Models\Admin;
use Validator;

class AuthController extends Controller
{
    protected $guard = 'admin';
    protected $redirectTo = 'admin';

    public function index()
    {
        return view('admin.auth.auth');
    }
}
