<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Whoops\Run;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        $auth = Auth::user();
        $users = User::with(['work' => function ($q) {
            return $q->where('check', '1')->where('status', 'Chưa hoàn thành');
        }])->withCount(['work' => function ($a) {
            return $a->where('check', '1')->where('status', 'Chưa hoàn thành');
        }])->orderBy('work_count')->get();
        $date = Carbon::now();
        $date->startOfDay();
        $works = Work::with('user')->where('check', '1')->where('status', 'Chưa hoàn thành')->orderBy('end_date', 'ASC')->get();
        $metting = User::where('deleted_at', null)->where('metting', '<>', '1')->where('metting', '<>', '3')->first();

        if ($metting == null) {
            $metting = User::where('deleted_at', null)->where('metting', '<>', '3')->first();
        }

        $secorndMetting = User::where('deleted_at', null)->where('id', '<>', $metting->id)->where('metting', '<>', '1')->where('metting', '<>', '3')->first();

        if ($secorndMetting == null) {
            $secorndMetting = User::where('deleted_at', null)->where('id', '<>', $metting->id)->where('metting', '<>', '3')->first();
            if ($secorndMetting == null) {
                $secorndMetting = User::where('deleted_at', null)->where('id', '<>', $metting->id)->first();
            }
        }
        $user = User::all();
        $array = [];
        foreach ($user as $key => $value) { 
            $a = $value->progress;
            if ($a != 0) {
                $array[$value->id] = $a;
            }
        }
        return view('user.Screen.home', compact('users', 'date', 'auth', 'works', 'metting', 'secorndMetting', 'array'));
    }


    public function metting(Request $request)
    {
        $auth = Auth::user();

        $user = User::where('id', $request->id)->update([
            'metting' => $request->metting,
        ]);
        
        $users1 = User::where('metting','0')->get();
        
        $soluong1 = count($users1);
        if ($soluong1 == 0) {
            $user = User::where('id', '<>', '0')->update([
                'metting' => 0,
            ]);
            if($request->metting == 1){
                $user = User::where('id', $request->id)->update([
                    'metting' => $request->metting,
                ]);
            }
        }
        return redirect()->back();
    }

    // notification
    public function notification()
    {
        $works = Work::where('check',0)->where('status','Chưa hoàn thành')->get();
        
        $array = [];
        foreach($works->groupBy('user_name') as $key=> $work)
        {
            
            $a =  count($work);
            $array[$key]= $a;
        }
        $users = User::where('metting',2)->get();
        
        $array1 = [];
        foreach($users->groupBy('name') as $key1=> $user)
        {
            
            $a1 =  count($user);
            $array1[$key1]= $a1;
        }
        return response()->json([
            'data'  => $array,
            'data1' => $array1
        ]);
    }









    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

