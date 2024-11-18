<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $filePath = 'uploads/profiles';
            $imagePath = saveImage($image, $filePath);

            $user->profile= $imagePath;
        }

        $user->save();

        return responseJson([
            'message' => 'Profile updated successfully!'
        ], 'success', 200);
    }
}
