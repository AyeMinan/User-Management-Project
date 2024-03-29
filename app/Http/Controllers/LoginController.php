<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function create(){
        return view("login.create");
    }
    public function store(Request $request){
        $cleanData = request()->validate([
            "email"=> ["required", "email", Rule::exists("users" , "email")],
            "password"=> ["required"]
        ],[
            'email.exists' => 'Your email does not exist',
        ]);


            if(auth()->attempt($cleanData)){

                return redirect("/")->with("message", "Welcome" . "" . auth()->user()->name ."");
            }else{
                return back()->withErrors(["password" => "Your password is incorrect"]);
            }
    }
}
