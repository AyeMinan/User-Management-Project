<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    public function index(){
        return view("main.index", [
            'users' => User::all()
        ]);
    }
    public function create(){
        return view("user.create", [
            'roles' => Role::all()
        ]);
    }

    public function store(){
        $cleanData = (request()->validate([
            'name' => ['required', 'max:20'],
            'email' => ['required', 'max:20'],
            'role_id' => 'required|exists:roles,id',
            'username' => ['required', 'max:20'],
            'password' => ['required', 'min:8', 'max:20'],
        ]));
        $cleanData['password'] = bcrypt($cleanData['password']);
        $user = new User();
        $user->name = $cleanData['name'];
        $user->role_id = $cleanData['role_id'];
        $user->email = $cleanData['email'];
        $user->username = $cleanData['username'];
        $user->password = $cleanData['password'];
        $user->save();

        auth()->login($user);

         return redirect('/user')->with('message' , 'Welcome' .''. $user->name .'');
    }


    public function delete(User $user){

        $user->delete();

        return redirect()->back()->with('message', 'User has been deleted');
    }
    public function edit(User $user){
        return view('user.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(User $user, Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role_id' => 'required|exists:roles,id',
        'username' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|max:255',
    ]);

    try {

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'username' => $request->input('username'),
            'password' => $request->input('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        return redirect('/user')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        // Handle any exceptions that might occur during the update process
        return redirect('/user')->with('error', 'An error occurred while updating the user.');
    }
}
}
