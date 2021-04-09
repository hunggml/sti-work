<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ManagerController extends Controller
{
    

    public function stafflist(){
        $auth = Auth::user();
        $users = User::with('group')->get();
        
        return view('user.manager.staff.stafflist',compact('users','auth'));
    }



    // form edit level staff
    public function editLevel(Request $request){
        $auth = Auth::user();
        $groups = Group::all();
        $user = User::findOrFail($request -> id);
        return view('user.manager.staff.editLevel', compact('user','auth','groups'));
    }

    // update level staff
    public function updateLevel(Request $request){
        $user = User::findOrFail($request->id);
        $user = DB::table('users', $request->id)->where('id', $request->id)->update([
            'level' => $request->level,
            'group_id' => $request->group_id,
        ]);
        // $user->save();
        toastr()->success('Cập nhật level thành công');
        return redirect()->route('staff.stafflist');
        
    }

    // list statistical
    public function statistical(){
        $users = User::with('work')->get();
        $auth = Auth::user();
        $date = Carbon::now();
        $date->startOfDay();
        $works = Work::all();
        return view('user.manager.statistical.statistical',compact('auth','date','works','users'));
    }

    // bar chart
    public function chart(){
        $auth = Auth::user();
        $users = User::with('work')->get();
        // dd($users);
        // return Response::json($users);
        return view('user.manager.chart.chart',compact('auth'));
    }

    // list work of staff
    public function workStaff(Request $request){
        $date = Carbon::now();
        $date->startOfDay();
        $auth = Auth::user();
        $work = Work::Where('user_id', $request->id)->where('hidden', '0')->get();
        
        return view('user.manager.work.listworkofStaff', compact('work', 'auth', 'date'));
    }

 
    // list check work
    public function listWorkCheck(){
        $date = Carbon::now();
        $date->startOfDay();
        $user = User::with(['work' => function($q){
            return $q->where('check', '0')->where('status','Chưa hoàn thành');
        }])->get();
        // dd($user);
        $auth = Auth::user();
        return view('user.manager.work.workcheck', compact('user', 'auth', 'date'));
    }

    
    // form check + edit work
    public function editWorkCheck(Request $request){
        $auth = Auth::user();
        $work = Work::findOrFail($request->id);
        return view('user.manager.work.editwork', compact('work','auth'));
    }

    
    // update work
    public function updateWorkCheck(Request $request){
        $this->validation($request);
        $work = Work::findOrFail($request->id);
        $work->fill($request->all());
        $work->save();
        toastr()->success('Cập nhật công việc thành công');
        return redirect()->route('check.list');
    }


    // delete work
    public function deleteWorkCheck(Request $request){
        $work = Work::findOrFail($request->id);
        $work->delete();
        toastr()->success('Xoá công việc thành công');
        return redirect()->route('check.list');
    }


    // delete staff
    public function destroyStaff(Request $request)
    {
        $user = User::findOrFail($request->id);
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
