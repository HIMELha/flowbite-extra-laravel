<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('admin.pages.index');
    }

    public function pricing()
    {
        return view('admin.pages.pricing');
    }

    public function fourzerofour()
    {
        return view('errors.404');

    }

    public function fivezerozero()
    {
        return view('errors.500');
    }

    public function maintenance()
    {
        return view('admin.pages.maintenance');
    }
}
