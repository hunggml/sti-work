<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginShow()
    {
        return view('auth.login');
    }

    public function registerShow(){
        return view('auth.register');
    }

    public function checkLogin(Request $request){
   
        $users = User::all();
        $validatedData = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $username = $user->username;
            $request->session()->push('login',$username);

            toastr()->success('Logged in successfully');
            return redirect()->route('home',compact('users'));
            // return redirect()->route('home',compact('users'))->with('login-correct','Logged in successfully');
        }
        else
        $validatedData = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|password',
        ]);
        {
            return redirect()->route('loginShow');
        }
     
    }

    public function logOut(Request $request){
        Auth::logout();
        toastr()->success('Logout is successfully');
        return redirect()->route('loginShow');
    }
}
