<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('admin.settings.index');
    }

    public function profile()
    {
        return view('admin.settings.profile');
    }
}
