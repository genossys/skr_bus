<?php

namespace App\Http\Controllers\Auth\Member;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Alert;

class LoginController extends Controller
{
    //

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        
        return view('auth.member.login');
    }

    function postlogin(Request $request)
    {
        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('username')
        ]);

        if (Auth::guard('member')->attempt($request->only($login_type, 'password'))) {
            return redirect('/');
        } else {
            Alert::error('Periksa username atau password anda', 'Gagal');
            return redirect()->back()->withInput();
        }
    }

    function logout()
    {
        Auth::guard('member')->logout();
        return redirect('/');
    }
}
