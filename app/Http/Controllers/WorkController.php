<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use App\WorkDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use App\Repositories\WorkInterface;
use Illuminate\Support\Facades\Auth;



class WorkController extends Controller
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
        $auth = Auth::user();
        $work = Work::Where('user_id', Auth::user()->id)->get();
        return view('user.work.list', compact('work','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $auth = Auth::user();
        return view('user.work.create',compact('auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $this->workInterface->check();
        if ($id) {
            $work = DB::table('works', $id)->where('id', $id)->update([
                'detail' => $request->detail,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'check' => $request->check,
            ]);
            toastr()->success('Thêm công việc thành công');

        } else {
            $validatedData = $request->validate([
                'detail' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
            ]);
            $user = User::Where('id', Auth::user()->id)->first();
            $work = new Work();
            $work->user_id = $user->id;
            $work->user_name = $user->name;
            $work->detail = $request->detail;
            $work->start_date = $request->start_date;
            $work->end_date = $request->end_date;
            $work->status = $request->status;
            $work->check = $request->check;
            $check =  Carbon::create($work->start_date)->diffInMinutes(Carbon::create($work->end_date), false);

            if ($check < 0) {
                toastr()->error('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
                return redirect()->route('work.create');
            } else
                $validatedData = $request->validate([
                    'detail' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'status' => 'required',
                ]); {
                $work->save();
                toastr()->success('Thêm công việc thành công');
            }
        }
        return redirect()->route('work.index');

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
        $work = Work::findOrFail($request->id);
        return view('user.work.edit', compact('work','auth'));
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
        $check =  Carbon::create($request->start_date)->diffInMinutes(Carbon::create($request->end_date), false);

        if ($check < 0) {
            toastr()->error('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
            return back();
        } else
            $validatedData = $request->validate([
                'detail' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
            ]); {
            $work = DB::table('works', $request->id)->where('id', $request->id)->update([
                'detail' => $request->detail,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'check' => $request->check,
            ]);
            toastr()->success('Cập nhật công việc thành công');
            $works = Work::Where('user_id', Auth::user()->id)->get();
            foreach ($works as $work) {
                if ($work->status === "Chưa hoàn thành") {
                    return redirect()->route('work.index');
                }
            }
            // dd(($works)[0]->status);
            $user = Auth::user();
            $this->workInterface->StoreWork($user->id, $user->name, null, null, null, 'Chưa hoàn thành',1);

            return redirect()->route('work.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $work = Work::findOrFail($request->id);
        if($work->status === "Chưa hoàn thành"){
            toastr()->error('Công việc cần phải hoàn thành');
            return back();
        }
        else{
        $work->delete();
        toastr()->success('Xoá công việc thành công');
        return redirect()->route('work.index');
        }
        
    }



    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getDateEndAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
