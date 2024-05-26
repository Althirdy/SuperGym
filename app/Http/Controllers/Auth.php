<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class Auth extends Controller
{
    public function index(){


    }

    public function checkLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

      
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Directly query the database to check the credentials
        $user = DB::table('gymbilog_user')
                    ->where('email', $request->email)
                    ->first();
    
        if ($user && md5($request->password) == $user->password) {
          
            Session::put('gymbilog_user', 'admin');
    
            return redirect()->intended('Dashboard'); 
        } else {
            // Authentication failed...
            return redirect()->back()->with('error', 'Invalid credentials')->withInput();
        }
    }

    public function logout()
    {
        Session::forget('gymbilog_user');
        return redirect('/');
    }
}
