<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use App\WorkDetail;
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
        $user = User::with(['work' => function($q){
            return $q->where('check', '1');
        }])->get();

        $date = Carbon::now();
        $date->startOfDay();
        // dd($user);
        return view('user.screen.home', compact('user', 'date','auth'));
    }

    public function home()
    {
        // $allWork = Work::all();
        $date = Carbon::now();
        $date->startOfDay();
        $user = User::with('work')->get();
        $auth = Auth::user();
        return view('customer.home.home', compact('user', 'auth', 'date'));
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
        $work = Work::findOrFail($request->id);

        return view('user.screen.edit', compact('work'));
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
        $validatedData = $request->validate([
            'detail' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        $work = DB::table('works', $request->id)->where('id', $request->id)->update([
            'detail' => $request->detail,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        toastr()->success('Cập nhật công việc thành công');
        return redirect()->route('home');
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
