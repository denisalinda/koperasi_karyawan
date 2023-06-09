<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class Login extends Controller
{
    function view_login()
    {
        return view('login.login');
    }

    function action_login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->with('captcha','capthca harus di isi');
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data2 = user::where('email', $request->input('email'))->count();

        if($data2 != 0){

            $data = user::where('email', $request->input('email'))->first();
     
    
                if($data->is_active == '1'){
                    if (Auth::attempt($credentials)) {
                        $request->session()->regenerate();
            
                        return redirect()->intended('/admin/dashboard');
                    }
                }
            }
            return back()  ->with('captcha','username atau password salah!');
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
