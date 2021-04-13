<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserInterface;

class UserController extends Controller
{


    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
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
            // 'name' => 'required|unique:users,name',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:3',
            're-password' => 'required|same:password',
        ]);

        $name = explode(' ',$request->name);
        $name1 = array_diff($name,[""]);
        // dd($name1);
        if(count($name1) <= 2)
        {
            toastr()->error('Họ Và Tên Không Thỏa Mãn ( Họ_Tên Đệm_Tên');
            return redirect()->back();
        }
        else
        {  
            $ten = '' ;
            foreach($name1 as $key => $val)
            {
                if($key < count($name1)-1)
                {
                    if($key == 0 ){
                        $ten = $ten.''.$val[0];
                    }
                    else{
                        $ten = $ten.'.'.$val[0];
                    }
                    
                }
                else 
                {
                    $ten = $ten.'.'.$val; 
                }
            }
            // $user = new User();
            // $user->name = $ten; 
            // $user->username = $request->username;
            // $user->password = Hash::make($request->password);
            // $user->level = 2;
            // $user->group_id = 1;
            // $user->metting = 0;
            // $user->progress = 0;
            // $user->time_created = Carbon::now('Asia/Ho_Chi_Minh');
            // $user->time_updated = Carbon::now('Asia/Ho_Chi_Minh');
            // $user->save();
            $this->userInterface->StoreUser(
                $ten,
                $request->username,
                Hash::make($request->password),
                2,
                1,
                0,
                0,
                Carbon::now('Asia/Ho_Chi_Minh'),
                Carbon::now('Asia/Ho_Chi_Minh')
            );

            toastr()->success('Tạo tài Khoản thành công');
            return redirect()->route('loginShow');
        }
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
        $name = explode(' ',$request->name);
        $name1 = array_diff($name,[""]);
       
        if(count($name1) <= 2)
        {
            toastr()->error('Họ Và Tên Không Thỏa Mãn ( Họ_Tên Đệm_Tên');
            return redirect()->back();
        }
        else
        {  
            $ten = '' ;
            foreach($name1 as $key => $val)
            {
                if($key < count($name1)-1)
                {
                    if($key == 0 ){
                        $ten = $ten.''.$val[0];
                    }
                    else{
                        $ten = $ten.'.'.$val[0];
                    }
                    
                }
                else 
                {
                    $ten = $ten.'.'.$val; 
                }
            }
        }
        $user = User::findOrFail($request ->id);
        $user = User::where('id',$request->id)->update([
            'name' => $ten,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email
        ]);
        $works = Work::where('user_id',$request->id)->update([
            'user_name' => $ten,
        ]);
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
        $this->validation($request);
        $account = User::Where('id',Auth::user()->id)->first();
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
            {
                $this->validation($request);
               return redirect()->route('changePass');
            }
        }
    }


    public function validation(Request $request){
        return $this->validate($request,[
            'oldPassword' => 'required|password|min:3',
            'newPassword' => 'required|min:3',
            'rePassword' => 'required|same:newPassword',
        ]);
    }
}
