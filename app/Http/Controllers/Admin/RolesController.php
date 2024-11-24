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
    public function index(Request $request)
    {
        $users = User::latest();
        $search = '';
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $users->where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%' .  $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        $users = $users->whereNot('id', Auth::user()->id)->latest()->paginate(12);
        return view('admin.roles.index', compact('users', 'search'));
    }

    public function edit($id){
        $user = User::find($id);

        if(!$user){
            session()->flash('error', "User not found");
            return redirect()->back();
        }

        return view('admin.roles.edit', compact('user'));
    }
}
