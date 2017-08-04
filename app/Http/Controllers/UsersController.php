<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

/*    public function __construct()
    {
        $this->middleware('auth');
    }*/


    public function getLogin()
    {
        return view('users.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect()->back()->with(['fail' => 'Unable to log you in, please verify your credentials and try again']);
        }
        return redirect()->route('dashboard');
    }
    
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }


}
