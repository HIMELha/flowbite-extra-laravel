<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'profile' => 'nullable|mimes:jpg,png,gif,jpeg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors()
            ], 'error', 422);
        }

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');



        if ($request->hasFile('profile')) {
            deleteOldImage($user->profile);

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

        $user = Auth::user();

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return responseJson([
            'message' => 'Password updated successfully'
        ], 'success', 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|max:100',
            'site_title' => 'required|max:150',
            'site_logo' => 'nullable|mimes:jpg,png,gif,jpeg,webp|max:2048',
            'site_description' => 'nullable|max:255',
            'contact_info' => 'nullable|email|max:100',
            'facebook_link' => 'nullable|url|max:255',
            'youtube_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'whatsapp_link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors(),
            ], 'error', 422);
        }

        $settings = Setting::first();

        if (!$settings) {
            return responseJson([
                'message' => 'Settings not found'
            ], 'error', 200);
        }

        $settings->site_name = $request->site_name;
        $settings->site_title = $request->site_title;
        $settings->site_description = $request->site_description;
        $settings->contact_info = $request->contact_info;
        $settings->facebook_link = $request->facebook_link;
        $settings->youtube_link = $request->youtube_link;
        $settings->twitter_link = $request->twitter_link;
        $settings->whatsapp_link = $request->whatsapp_link;

        if ($request->hasFile('site_logo')) {
            deleteOldImage($settings->site_logo);

            $image = $request->file('site_logo');
            $filePath = 'uploads/settings';
            $imagePath = saveImage($image, $filePath);

            $settings->site_logo = $imagePath;
        }

        $settings->save();

        return responseJson([
            'message' => 'Settings updated successfully!',
            'redirect' => route('settings.index')
        ], 'success', 200);
    }
}
