<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\memberModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Alert;

class RegisterController extends Controller
{
    //

    use RegistersUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.member.register');
    }

    private function isValid(Request $r)
    {
        $messages = [];

        $rules = [
            'username' => 'required|max:191|unique:tb_member,username',
            'email' => 'required|max:191',
            'password' => 'required|string|min:6|confirmed',
            'nohp' => 'required|numeric|digits_between:1,15',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function register(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            $errors = $this->isValid($r)->errors();
            Alert::error('Registrasi Anda Gagal', 'Ooops');
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            try {
                $member = new memberModel();
                $member->username = $r->username;
                $member->email = $r->email;
                $member->password = Hash::make($r->password);
                $member->nohp = $r->nohp;
                if ($member->save()) {
                    $credentials = $r->only('email', 'password');
                    if (Auth::guard('member')->attempt($credentials)) {
                        Alert::success('Selamat', 'Registrasi Anda Berhasil');
                        return redirect('/');
                    }
                }
            } catch (\Exception  $e) {
                Alert::error('Gagal Register', 'Gagal');
                return redirect()->back()->withInput();
            }
        }
    }
}
