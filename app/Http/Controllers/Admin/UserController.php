<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(12);
        
        return view('admin.users.index', compact('users'));
    }


    public function delete($id){
        $user = User::find($id);

        if(!$user){

        }

        $user->delete();       
    }
}
