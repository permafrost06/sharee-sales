<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all()->where('type','!=','app_user');
        return view('admin.users.index',['users'=>$users]);
    }

    public function create(){
        return view('admin.users.create');
    }
    public function edit(Request $request){
        $user = User::find($request->id);

        return view('admin.users.edit',['user'=>$user]);
    }

    public function update(Request $request){
        $user = new User();
        $update = $user->updateUser($request);
        if ($update==1){
            return redirect()->back()->with(['message'=>'User type changed']);
        }
        return redirect()->back()->with(['message'=>'Unable to update']);
    }
}
