<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function profile()
    {
        return view('admin.settings.profile');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'profile' => 'required|mimes:jpg,png,gif,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors()
            ], 'error', 422);
        }

        $user = auth()->user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        deleteOldImage($user->profile);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $filePath = 'uploads/profiles';
            $imagePath = saveImage($image, $filePath);

            $user->profile = $imagePath;
        }

        $user->save();

        return responseJson([
            'message' => 'Profile updated successfully!'
        ], 'success', 200);
    }


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return responseJson(['errors' => $validator->errors()], 'error', 422);
        }

        if (
            $request->password !==
            $request->confirm_password
        ) {
            return responseJson(['errors' => ['confirm_password' => ['Password combination doesnot match']]], 'error', 422);
        }

        $user = auth()->user();


        $user->password = Hash::make($request->input('password'));
        $user->save();

        return responseJson([
            'message' => 'Password updated successfully'
        ], 'success', 200);
    }
}
