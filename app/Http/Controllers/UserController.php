<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\WorkInterface;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    public function __construct(WorkInterface $workInterface)
    {
        $this->workInterface = $workInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $auth = Auth::user();
        $user = User::Where('id',Auth::user()->id)->get();
        return view('user.auth.profile',compact('user','auth'));
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
            'password' => 'required|min:3',
            're-password' => 'required|same:password',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = 2;
        $user->time_created = Carbon::now('Asia/Ho_Chi_Minh');
        $user->time_updated = Carbon::now('Asia/Ho_Chi_Minh');
        $user->save();

        toastr()->success('Đăng ký thành công');
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
        $auth = Auth::user();

        $user = User::findOrFail($request -> id);
        return view('user.auth.editProfile', compact('user','auth'));
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

        ]);

        $user = User::findOrFail($request ->id);
        $user->fill($request->all());
        $user->save();

        toastr()->success('Cập nhật hồ sơ thành công');
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::Where('id', Auth::user()->id)->first();
        $user->delete();
        $works = Work::Where('user_id', Auth::user()->id)->get();
        foreach($works as $work){
            $id = Work::Where('id',$work->id)->first();
            $id->delete();
        }
        toastr()->success('Xoá tài khoản thành công');
        return redirect()->route('trangchu');
    }


    public function changePass(){
        $auth = Auth::user();

        return view('user.auth.changePass',compact('auth'));
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
                toastr()->success('Thay đổi mật khẩu thành công');
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
