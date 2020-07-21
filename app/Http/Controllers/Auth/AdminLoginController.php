<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin');
    }
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    public function login(Request $request)
    {
        //form data validation
        $this->validate($request,[
            'email' => 'required|email',
            'password' =>'required|min:6'
        ]);
        //attempt to login
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember))
        {
            //success
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
