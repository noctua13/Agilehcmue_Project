<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect('/');
    }

    /**
     * Login
	 *If successful, redirect to Dashboard
	 *if unsuccessful, returns error
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //Retrieve user info
		$user = User::select('username', 'password')->where('username', $request['username'])->first();
		//If user does not exist
		if ($user === null) return view('login');
		//If user exists
		//Correct password
		if (Hash::check($request['password'], $user->password))	
		{
			$credentials = $request->only('username', 'password');
			if (Auth::attempt($credentials)) 
			{
				$request->session()->regenerate();
				return redirect()->intended('dashboard.html');
			}				
			//return view('dashboard');
		}
		//Incorrect password
		else 
		{
			return back()->withErrors([
				'username' => 'The provided credentials do not match our records.',
			]);
			//return view('login');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
		$user= new User();
		$user->username = $request['username'];
		$user->password = Hash::make($request['password']);
		$user->name = $request['name'];
		$user->address = $request['address'];
		$user->phone = $request['phone'];
		$user->email = $request['email'];
		$user->isverified = false;
		$user->permission = 0;
		$user->save();
        $request->session()->put('success-register','Register Successfully!');
		return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
