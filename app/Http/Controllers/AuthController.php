<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
      return view('admin.login.index');
    }



        public function postLogin(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials)) {

             Session::flash('success',  'تمت تسجيل الدخول بنجاح');

            $request->session()->regenerate();

            return redirect()->route('users.index');
        }

        return back()->onlyInput('email')->withFlashMessage('يرجى التأكد من البريدالالكتروني و كلمة المرور');

}

}