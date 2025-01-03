<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function verifyLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:50',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors()->first()
            ], 'error', 422);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return responseJson([
                'error' => 'Login attempt failed'
            ], 'error', 401);
        }

        if (Auth::user()->hasRole(['superadmin', 'staff', 'admin', 'moderator', 'customersupport', 'financemanager', 'manager'])) {
            return responseJson([
                'message' => 'Login attempt success',
                'redirect' => route('dashboard.index')
            ], 'success', 200);
        } else {
            return responseJson([
                'error' => 'You need a valid role to access admin dashboard'
            ], 'error', 403);
        }
    }

    public function forget()
    {
        return view('admin.auth.forget');
    }

    public function reset()
    {
        return view('admin.auth.reset');
    }

    public function lock()
    {
        return view('admin.auth.lock');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('dashboard.login');
    }
}
