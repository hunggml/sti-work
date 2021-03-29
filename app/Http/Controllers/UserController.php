<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('staff.list',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone' => 'required|min:9|max:12|unique:users,phone|',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            're-password' => 'required|same:password',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->time_created = Carbon::now('Asia/Ho_Chi_Minh');
        $user->time_updated = Carbon::now('Asia/Ho_Chi_Minh');
        $user->save();

        toastr()->success('Register is successfully');
        return redirect()->route('loginShow');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::findOrFail($request -> id);
        return view('staff.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phone' => 'required|min:9|max:12',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($request ->id);
        $user->fill($request->all());
        $user->save();

        toastr()->success('Update staff is successfully');
        return redirect()->route('staff.index');
        // return redirect()->route('staff.index')->with('update-user','Update staff is successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request -> id);
        $user->delete();

        toastr()->success('Staff delete successfully');
        return redirect()->route('staff.index');
    }

    public function changePass(){
        return view('auth.changePass');
    }

    public function updatePass(Request $request){
        $validatedData = $request->validate([
            'oldPassword' => 'required|password|min:3',
            'newPassword' => 'required|min:3',
            'rePassword' => 'required|same:newPassword',
        ]);
        $account = User::Where('id',Auth::user()->id)->get();
        $userPassword = $account->password;
        $correctPassword = Hash::check($request->oldPassword, $userPassword);
        $correctPasswordConfirm = $request->newPassword === $request->rePassword;
        if($correctPassword){
            if ($correctPasswordConfirm) {
                $account->password = Hash::make($request->newPassword);
                toastr()->success('Change Password is successfully');
                $account->save();
                return redirect()->route('home');
            } else 
            $validatedData = $request->validate([
                'oldPassword' => 'required|password|min:6',
                'newPassword' => 'required|min:6',
                'rePassword' => 'required|same:newPassword',
            ]); 
            {
               return redirect()->route('changePass');
            }
        }
    }
}
