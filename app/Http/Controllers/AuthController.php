<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Whoops\Run;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginShow()
    {
        return view('user.auth.login');
    }

    public function registerShow(){
        return view('user.auth.register');
    }

    public function checkLogin(Request $request){
   
        $users = User::all();
        // $validatedData = $request->validate([
        //     'username' => 'required|exists:users,username',
        //     'password' => 'required',
        // ]);
        $remember = $request->has('remember') ? true : false;
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password],$remember)){
            $user = Auth::user();
            $username = $user->username;
            $request->session()->push('login',$username);

            toastr()->success('Đăng nhập thành công!');
            return redirect()->route('home',compact('users'));
            // return redirect()->route('home',compact('users'))->with('login-correct','Logged in successfully');
        }
        else
        
        $validatedData = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|password',
        ]);
        {
            return redirect()->route('loginShow');
        }
     
    }

    public function logOut(Request $request){
        Auth::logout();
        // $request->session()->has('login');
        
        toastr()->success('Đăng xuất thành công!');
        return redirect()->route('trangchu');
    }
}
