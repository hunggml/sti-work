<?php

namespace App\Http\Controllers;

use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use App\Repositories\WorkInterface;
use App\WorkHistoryEdit;
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
        $date = Carbon::now();
        $date->startOfDay();
        $auth = Auth::user();
        $work = Work::Where('user_id', Auth::user()->id)->where('hidden', '0')->get();
        return view('user.work.list', compact('work', 'auth', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $auth = Auth::user();
        return view('user.work.create', compact('auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $check =  Carbon::create($request->start_date)->diffInMinutes(Carbon::create($request->end_date), false);
        if ($check < 0) {
            toastr()->error('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
            return redirect()->route('work.create');
        } else {
            $date = Carbon::now();
            $date->startOfDay();
            $this->validation($request);
            $user = User::Where('id', Auth::user()->id)->first();

            if ($user->level == 1) {
                $this->workInterface->StoreWork(
                    $user->id,
                    $user->name,
                    $request->detail,
                    $request->start_date,
                    $request->end_date,
                    $request->status,
                    1,
                    $request->progress,
                    $request->hidden,
                );
            } else {
                $this->workInterface->StoreWork(
                    $user->id,
                    $user->name,
                    $request->detail,
                    $request->start_date,
                    $request->end_date,
                    $request->status,
                    $request->check,
                    $request->progress,
                    $request->hidden,
                );
            }


            toastr()->success('Thêm công việc thành công');
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
        return view('user.work.edit', compact('work', 'auth'));
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
        $date = Carbon::now();
        $date->startOfDay();
        $this->validation($request);
        $check =  Carbon::create($request->start_date)->diffInMinutes(Carbon::create($request->end_date), false);
        $works = Work::where('id', $request->id)->with('workHistoryEdit')->first();
        $user = User::Where('id', Auth::user()->id)->first();
        if ($check < 0) {
            toastr()->error('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
            return back();
        } 
        else {
            if($user->level == 1 ) {
                $this->validation($request);
                $this->workInterface->StoreWorkHistory(
                    $works->id,
                    $works->detail,
                    $works->start_date,
                    $works->end_date,
                    $works->status,
                );
                $work = $this->workInterface->UpdateWork(
                    $request->id,
                    $request->detail,
                    $request->start_date,
                    $request->end_date,
                    $request->status,
                    1,
                    $request->progress,
                    $request->hidden,
                );
                toastr()->success('Cập nhật công việc thành công');
                return redirect()->route('work.index');
            }
            else{
                $this->validation($request);
                if (
                    $date->diffInDays(Carbon::create($request->end_date), false) < 0 && $request->status == 'Chưa hoàn thành' ||
                    $date->diffInDays(Carbon::create($request->end_date), false) < 0 && $request->status == 'Hoàn thành'
                ) {
                    $this->workInterface->StoreWorkHistory(
                        $works->id,
                        $works->detail,
                        $works->start_date,
                        $works->end_date,
                        $works->status,
                    );
                    $work = $this->workInterface->UpdateWork(
                        $request->id,
                        $request->detail,
                        $request->start_date,
                        $request->end_date,
                        $request->status,
                        $request->check,
                        2,
                        $request->hidden
                    );
                    User::where('id', $user->id)->update([
                        'progress' => $user->progress + 1
                    ]);
                } elseif ($date->diffInDays(Carbon::create($request->end_date), false) >= 0 && $request->status == 'Hoàn thành') {
                    $this->workInterface->StoreWorkHistory(
                        $works->id,
                        $works->detail,
                        $works->start_date,
                        $works->end_date,
                        $works->status,
                    );
                    $work = $this->workInterface->UpdateWork(
                        $request->id,
                        $request->detail,
                        $request->start_date,
                        $request->end_date,
                        $request->status,
                        $request->check,
                        1,
                        $request->hidden,
                    );
                } 
                else {
                    $this->workInterface->StoreWorkHistory(
                        $works->id,
                        $works->detail,
                        $works->start_date,
                        $works->end_date,
                        $works->status,
                    );
                    $work = $this->workInterface->UpdateWork(
                        $request->id,
                        $request->detail,
                        $request->start_date,
                        $request->end_date,
                        $request->status,
                        $request->check,
                        $request->progress,
                        $request->hidden,
                    );
                }
            }
            toastr()->success('Cập nhật công việc thành công');
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
        if ($work->status === "Chưa hoàn thành") {
            toastr()->error('Công việc cần phải hoàn thành');
            return back();
        } else {
            $work->delete();
            toastr()->success('Xoá công việc thành công');
            return redirect()->route('work.index');
        }
    }


    // Lưu trữ
    public function storage($id)
    {
        Work::findOrFail($id)->update([
            'hidden' => 1,
        ]);
        toastr()->success('Lưu trữ thành công');
        return redirect()->route('work.index');
    }

    // List lưu trữ
    public function listWarehouse(Request $request)
    {
        $date = Carbon::now();
        $date->startOfDay();
        $auth = Auth::user();
        $work = Work::Where('user_id', Auth::user()->id)->where('hidden', '1')->get();
        return view('user.work.warehouse', compact('work', 'auth', 'date'));
    }

    // Khôi phục
    public function restore($id)
    {
        Work::findOrFail($id)->update([
            'hidden' => 0,
        ]);
        toastr()->success('Khôi phục thành công');
        return redirect()->route('warehouse.list');
    }

    // history work
    public function history(Request $request)
    {
        $auth = Auth::user();
        $date = Carbon::now();
        $date->startOfDay();
        $history = WorkHistoryEdit::where('work_id', $request->id)->get();
        return view('user.work.historyWork', compact('history', 'auth', 'date'));
    }



    public function validation(Request $request)
    {
        return $this->validate($request, [
            'detail' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);
    }
}
