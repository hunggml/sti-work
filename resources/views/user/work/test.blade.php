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
        $date = Carbon::now();
        $date->startOfDay();
        $auth = Auth::user();
        $work = Work::Where('user_id', Auth::user()->id)->where('hidden','0')->get();

        return view('user.work.list', compact('work','auth','date'));
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
            toastr()->success('Thêm công việc thành công');

        } else {
            $this->validation($request);
            $user = User::Where('id', Auth::user()->id)->first();
            $work = $this->workInterface->StoreWork(
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
            $check =  Carbon::create($work->start_date)->diffInMinutes(Carbon::create($work->end_date), false);

            if ($check < 0) {
                toastr()->error('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
                return redirect()->route('work.create');
            } else
            {
                $this->validation($request);
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
        $date = Carbon::now();
        $date->startOfDay();
        $this->validation($request);
        $check =  Carbon::create($request->start_date)->diffInMinutes(Carbon::create($request->end_date), false);

        if ($check < 0) {
            toastr()->error('Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc');
            return back();
        } else
        {
            $this->validation($request);
         
            if($date->diffInDays(Carbon::create($request->end_date), false) < 0 && $request->status == 'Chưa hoàn thành' || 
                $date->diffInDays(Carbon::create($request->end_date), false) < 0 && $request->status == 'Hoàn thành')
            {
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
            }
            elseif($date->diffInDays(Carbon::create($request->end_date), false) >= 0 && $request->status == 'Hoàn thành')
            {
                $work = $this->workInterface->UpdateWork(
                    $request->id,
                    $request->detail, 
                    $request->start_date, 
                    $request->end_date, 
                    $request->status,
                    $request->check,
                    1,
                    $request->hidden
                );
            }
           
            else{
                $work = $this->workInterface->UpdateWork(
                    $request->id,
                    $request->detail, 
                    $request->start_date, 
                    $request->end_date, 
                    $request->status,
                    $request->check,
                    $request->progress,
                    $request->hidden
                );
            }

           
            toastr()->success('Cập nhật công việc thành công');
            $works = Work::Where('user_id', Auth::user()->id)->get();
            foreach ($works as $work) {
                if ($work->status === "Chưa hoàn thành") {
                    return redirect()->route('work.index');
                }
            }
            // dd(($works)[0]->status);
            $user = Auth::user();
            $this->workInterface->StoreWork($user->id, $user->name, null, null, null, 'Chưa hoàn thành',1,0,0);

            return redirect()->route('work.index');
        }

    }