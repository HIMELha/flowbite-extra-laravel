<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; 
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(12);
        
        return view('admin.roles.index', compact('users'));
    }
}
