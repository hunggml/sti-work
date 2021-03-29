<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use App\WorkDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;




class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work = Work::Where('user_id',Auth::user()->id)->get();
        return view('work.list',compact('work'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        return view('work.create');
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
            'detail' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        $user = Auth::user();
        $work = new Work();
        $work->user_id = $user->id;
        $work->user_name = $user->name;
        $work->detail = $request->detail;
        $work->start_date = $request->start_date;
        $work->end_date = $request->end_date;
        $work->status = $request->status;
        $work->save();


        toastr()->success('Work added successfully');
        // return redirect()->route('work.index');
           
        // return Response::json($work);
        
        // return redirect()->route('work.index')->with('add-work','job added successfully');
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
        $work = Work::findOrFail($request -> id);
        
        return view('work.edit',compact('work'));
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
        // dd($request);
        $validatedData = $request->validate([
            'detail' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
        $work = DB::table('works',$request->id)->where('id',$request->id)->update([
            'detail' => $request->detail,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        toastr()->success('Work update successfully');
        return redirect()->route('work.index');
        // return redirect()->route('work.index')->with('update-work','Job update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $work = Work::findOrFail($request -> id);
        $work->delete();
        toastr()->success('Work delete successfully');
        return redirect()->route('work.index');
        // return redirect()->route('work.index')->with('delete-work','Job delete successfully');
    }


public function getDateStartAttribute($value)
{
    return Carbon::parse($value)->format('Y-m-d\TH:i');
}

public function getDateEndAttribute($value)
{
    return Carbon::parse($value)->format('Y-m-d\TH:i');
}
}
