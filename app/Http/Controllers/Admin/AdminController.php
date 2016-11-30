<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function clearallstorage()
    {
    	$url = url()->previous();
    	\Cache::flush();
    	\Artisan::call('view:clear');
    	return redirect($url);
    }
}
