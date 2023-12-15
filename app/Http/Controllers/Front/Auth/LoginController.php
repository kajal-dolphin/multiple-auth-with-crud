<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function showLoginPage(){
        return view('front.auth.login');
    }

    public function postLogin(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->status == '1'){
                return redirect()->route('user.dashboard')->with('success','You Have Successfully Logged In !!');
            }
            else{
                return redirect()->route('user.show.login.page')->with('error', 'You are not active user !!');
            }
        }
        return redirect()->route('user.show.login.page')->with('error', 'Sorry !! Your Credentials Is Not Matched !!');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('user.show.login.page');
    }
}
