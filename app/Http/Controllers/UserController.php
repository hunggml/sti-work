<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\WorkInterface;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(WorkInterface $workInterface)
    {
        $this->workInterface = $workInterface;
    }

    public function index()
    {
        $user = User::Where('id',Auth::user()->id)->get();
        return view('auth.profile',compact('user'));
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
            'name' => 'required|unique:users,name',
            'username' => 'required|unique:users,username',
            // 'phone' => 'required|min:9|max:12|unique:users,phone|',
            // 'address' => 'required',
            // 'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            're-password' => 'required|same:password',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        // $user->phone = $request->phone;
        // $user->address = $request->address;
        // $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->time_created = Carbon::now('Asia/Ho_Chi_Minh');
        $user->time_updated = Carbon::now('Asia/Ho_Chi_Minh');
        $user->save();
        $this->workInterface->StoreWork($user->id,$user->name,null,null,null,'Chưa hoàn thành',);

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
        return view('auth.editProfile', compact('user'));
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
            // 'phone' => 'min:9|max:12',
            // 'address' => 'required',
            // 'email' => 'email',
        ]);

        $user = User::findOrFail($request ->id);
        $user->fill($request->all());
        $user->save();

        toastr()->success('Update profile is successfully');
        return redirect()->route('profile.index');
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

        toastr()->success('proflie delete successfully');
        return redirect()->route('profile.index');
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
        $account = User::Where('id',Auth::user()->id)->first();
        // dd($account);
        $userPassword = $account->password;
        $correctPassword = Hash::check($request->oldPassword, $userPassword);
        $correctPasswordConfirm = $request->newPassword === $request->rePassword;
        if($correctPassword){
            if ($correctPasswordConfirm) {
                $account->password = Hash::make($request->newPassword);
                $account->save();
                toastr()->success('Change Password is successfully');
                return redirect()->route('changePass');
            } else 
            $validatedData = $request->validate([
                'oldPassword' => 'required|password|min:3',
                'newPassword' => 'required|min:3',
                'rePassword' => 'required|same:newPassword',
            ]); 
            {
               return redirect()->route('changePass');
            }
        }
    }
}
