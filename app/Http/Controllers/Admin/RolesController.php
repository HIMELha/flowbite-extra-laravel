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

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            session()->flash('error', "User not found");
            return redirect()->back();
        }

        $roles = Role::all();

        return view('admin.roles.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return responseJson([
                'error' => 'User not found',
                'redirect' => route('roles.index')
            ], 'error', 200);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors()
            ], 'error', 422);
        };

        $user->name = $request->name;
        $user->syncRoles($request->roles);

        $user->save();

        return responseJson([
            'message' => "user roles updated successfully",
            'redirect' => route('roles.index')
        ], 'success', 200);
    }
}
