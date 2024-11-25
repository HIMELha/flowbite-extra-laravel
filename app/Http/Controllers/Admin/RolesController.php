<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

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

    public function permissions(Request $request)
    {
        $permissions = Permission::latest();
        $search = '';
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $permissions->where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%' .  $search . '%');
            });
        }

        $permissions = $permissions->latest()->paginate(12);
        return view('admin.roles.permission', compact('permissions', 'search'));
    }

    public function createPermission()
    {
        return view('admin.roles.permission_create');
    }

    public function storePermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name|max:255',
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors()
            ], 'error', 422);
        }

        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return responseJson([
            'message' => 'Permission created successfully',
            'redirect' => route('roles.permissions'),
        ], 'success', 200);
    }


    public function editPermission($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            session()->flash('error', "Permission not found");
            return redirect()->back();
        }

        return view('admin.roles.permission_edit', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return responseJson([
                'error' => 'Permission not found',
                'redirect' => route('roles.permissions'),
            ], 'error', 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $id . '|max:255',
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors(),
            ], 'error', 422);
        }

        $permission->name = $request->name;
        $permission->save();

        return responseJson([
            'message' => 'Permission updated successfully',
            'redirect' => route('roles.permissions'),
        ], 'success', 200);
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            session()->flash('success', "Permission not found");
            return redirect()->back();
        }

        $permission->delete();

        session()->flash('error', "Permission deleted successfully");
        return redirect()->back();
    }

    public function roles(Request $request)
    {
        $roles = Role::latest();
        $search = '';
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $roles->where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%' .  $search . '%');
            });
        }

        $roles = $roles->latest()->paginate(12);
        return view('admin.roles.roles', compact('roles', 'search'));
    }


    public function editRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            session()->flash('error', "Permission not found");
            return redirect()->back();
        }

        $permissions = Permission::all();

        return view('admin.roles.role_edit', compact('role', 'permissions'));
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return responseJson([
                'error' => 'Role not found',
                'redirect' => route('roles.roles'),
            ], 'error', 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors(),
            ], 'error', 422);
        }

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return responseJson([
            'message' => 'Role updated successfully',
            'redirect' => route('roles.roles'),
        ], 'success', 200);
    }
}
