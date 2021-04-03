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

class ManagerController extends Controller
{
    
    public function allStaff()
    {
        $auth = Auth::user();
        $users = User::all();
        return view('user.manager.staff.stafflist',compact('users','auth'));
    }


    public function editLevel(Request $request){
        $auth = Auth::user();
        $user = User::findOrFail($request -> id);
        return view('user.manager.staff.editLevel', compact('user','auth'));
    }

    
    public function updateLevel(Request $request){
        $user = User::findOrFail($request->id);
        $user->fill($request->all());
        $user->save();
        toastr()->success('Cập nhật level thành công');
        return redirect()->route('staff.list');
    }

    public function statistical(){
        $users = User::with('work')->get();
        $auth = Auth::user();
        $date = Carbon::now();
        $date->startOfDay();
        $works = Work::all();

        return view('user.manager.statistical.statistical',compact('auth','date','works','users'));
    }


    public function listWorkCheck(){
        $date = Carbon::now();
        $date->startOfDay();
        $user = User::with(['work' => function($q){
            return $q->where('check', '0')->where('status','Chưa hoàn thành');
        }])->get();
        $auth = Auth::user();
        return view('user.manager.work.workcheck', compact('user', 'auth', 'date'));
    }


    public function editWorkCheck(Request $request){
        $auth = Auth::user();
        $work = Work::findOrFail($request->id);
        return view('user.manager.work.editwork', compact('work','auth'));
    }

    
    public function updateWorkCheck(Request $request){
        $this->validation($request);
        $work = Work::findOrFail($request->id);
        $work->fill($request->all());
        $work->save();
        toastr()->success('Cập nhật công việc thành công');
        return redirect()->route('check.list');
    }


    public function deleteWorkCheck(Request $request){
        $work = Work::findOrFail($request->id);
        $work->delete();
        toastr()->success('Xoá công việc thành công');
        return redirect()->route('check.list');
    }


    public function destroyStaff(Request $request)
    {
        $user = User::findOrFail($request->id);
        // $user = User::Where('id', Auth::user()->id)->first();
        $user->delete();
        $works = Work::Where('user_id', $user->id)->get();
        foreach($works as $work){
            $id = Work::Where('id',$work->id)->first();
            $id->delete();
        }
        toastr()->success('Xoá nhân viên thành công');
        return redirect()->route('staff.list');
    }


    public function validation(Request $request){
        return $this->validate($request,[
            'detail' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
    }

    
}
