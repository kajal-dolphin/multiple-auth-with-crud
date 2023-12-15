<?php

namespace App\Http\Controllers\Front\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showUserDashboard(){
        if(Auth::user()){
            return view('front.dashboard.user_dashboard');
        }
        return redirect()->route('user.show.login.page');
    }
}
