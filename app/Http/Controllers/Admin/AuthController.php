<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function verifyLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:50',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return responseJson([
                'errors' => $validator->errors()
            ], 'error', 422);
        }



        return view('admin.auth.login');
    }

    public function reset()
    {
        return view('admin.auth.login');
    }
}
