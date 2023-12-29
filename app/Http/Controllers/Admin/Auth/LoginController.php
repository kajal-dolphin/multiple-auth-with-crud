<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginPage(){
        return view('admin.auth.login');
    }

    public function postLogin(LoginRequest $request){
        $userData = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::guard('admin')->attempt($userData) || Auth::guard('user')->attempt($userData)) {
            return redirect()->route('admin.dashboard')->with('success','login successfully !!');
        }
        return redirect()->route('admin.show.login.page')->with('error', 'Sorry !! Your Credentials Is Not Matched !!');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
  
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.show.login.page');
    }
}
