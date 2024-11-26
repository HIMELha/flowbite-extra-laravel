<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; // Update this if your User model is in another namespace
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

        if (Auth::user()->hasRole(['super_admin', 'admin', 'moderator', 'customer_support', 'finance_manager', 'manager'])) {
            return responseJson([
                'message' => 'Login attempt success',
                'redirect' => route('dashboard.index')
            ], 'success', 200);
        } else {
            return responseJson([
                'error' => 'You need to be an admin to access admin dashboard'
            ], 'error', 403);
        }
    }

    public function reset()
    {
        return view('admin.auth.login');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('dashboard.login');
    }
}
