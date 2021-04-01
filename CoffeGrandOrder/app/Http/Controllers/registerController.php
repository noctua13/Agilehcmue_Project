<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\DB;

class registerController extends Controller
{
    //function dk
    function registerFunction(Request $req){
        $data = $req->input();
        $req->session()->put('username', $data['username']);
        $req->session()->put('email', $data['email']);
        $req->session()->put('phone', $data['phonenumber']);
        $req->session()->put('name', $data['yourname']);
        
        $req->validate([
            'username'=>'required|unique:users|min:4',
            'password'=>'required',
            'email'=>'required|unique:users',
            'phonenumber'=>'required|min:10',
            'yourname'=>'required|min:3'
        ]);

        //check Id and Email
        //user DB from facades
        

        
            $userIntoDB = new users;
            $userIntoDB->username = $req->username;
            $userIntoDB->password = $req->password;
            $userIntoDB->email = $req->email;
            $userIntoDB->name = $req->yourname;
            $userIntoDB->permission = 0;
            $userIntoDB->isverified = 0;
            $userIntoDB->phone = $req->phonenumber;
            $userIntoDB->address = 'EMPTY';
            $userIntoDB->save();

            return view('registerSuccess');
        
    }
}
