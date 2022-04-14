<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $users = User::select('*')      
        ->orderBy('id','desc')
        ->paginate(10);
      return view('auth.index', ['users' => $users]);
        
    }
    public function create()
    {
        return view('auth.create');
    }
    public function store(UserRequest $request)
    {
        $userRequest = $request->all();
        $user = new User();
        $user->name = $userRequest['name'];
        $user->email = $userRequest['email'];
        $user->password = Hash::make($userRequest['password']);
        $user->save();
        return redirect()->route('users.index');
    }
    public function edit(User $id){
        return view('auth.create', ['user' => $id]);
        
    }
    public function delete(User $cate) {
        if ($cate->delete()) {
            return redirect()->route('users.index');
        }
        $userDelete = User::destroy($cate);
        if ($userDelete !== 0) {
            return redirect()->route('users.index');
        }
    }
    public function update(UserRequest $request, User $id)
    {
        $cateUpdate=$id;
        $cateUpdate->name=$request->name;
        $cateUpdate->email =$request->email;
        $cateUpdate->password = Hash::make($request->password);
        $cateUpdate->Update();
        return redirect()->route('users.index');
    }
}

