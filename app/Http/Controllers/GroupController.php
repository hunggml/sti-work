<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use App\Repositories\WorkInterface;
use Illuminate\Support\Facades\Auth;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $groups = Group::all();
        return view('user.group.list', compact('groups', 'auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        return view('user.group.create', compact('auth'));
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
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->time_created = Carbon::now('Asia/Ho_Chi_Minh');
        $group->time_updated = Carbon::now('Asia/Ho_Chi_Minh');
        $group->save();
      
        toastr()->success('Thêm phòng ban thành công');
        return redirect()->route('group.list');
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
        $auth = Auth::user();
        $group = Group::findOrFail($request -> id);
        return view('user.group.edit', compact('group','auth'));
    }

    /**x
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $group = DB::table('groups', $request ->id)->where('id', $request ->id)->update([
           'name' => $request->name,
        ]);

        toastr()->success('Cập nhật phòng ban thành công');
        return redirect()->route('group.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $group = Group::findOrFail($request->id);
        $group->delete();
        toastr()->success('Xoá công việc thành công');
        return redirect()->route('group.list');
    }
}
