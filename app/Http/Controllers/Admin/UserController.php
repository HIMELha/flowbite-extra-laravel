<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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

        return view('admin.users.index', compact('users', 'search'));
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            session()->flash('error', 'User not found');
            return redirect()->back();
        }

        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            session()->flash('error', 'User not found');
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|min:6',
            'profile' => 'nullable|mimes:jpg,png,jpeg,webp,gif|max:1024'
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors()
            ], 'error', 422);
        }


        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->password) {
            $user->password = $request->input('password');
        }



        if ($request->hasFile('profile')) {
            deleteOldImage($user->profile);

            $image = $request->file('profile');
            $filePath = 'uploads/profiles';
            $imagePath = saveImage($image, $filePath);

            $user->profile = $imagePath;
        }

        $user->save();

        return responseJson([
            'message' => "User Data update successfully",
            'redirect' => route('user.index')
        ], 'success', 200);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            session()->flash('error', 'User not found');
            return redirect()->back();
        }

        if (in_array('super_admin', $user->roles->pluck('name')->toArray())) {
            session()->flash('error', 'Action unavailable');
            return redirect()->back();
        }


        $user->delete();
        session()->flash('success', 'User has been deleted');
        return redirect()->back();
    }
}
