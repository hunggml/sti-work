<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


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
        // dd($users);
        
        $works = Work::where('check', '1')->where('status', 'Chưa hoàn thành')->orderBy('end_date', 'ASC')->get();
        return view('user.Screen.home', compact('users', 'date', 'auth', 'works'));
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
