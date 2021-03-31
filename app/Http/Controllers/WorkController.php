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
        $work = Work::Where('user_id', Auth::user()->id)->paginate(5);
        return view('work.list', compact('work'));
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
        $id = $this->workInterface->check();
        if ($id) {
            $work = DB::table('works', $id)->where('id', $id)->update([
                'detail' => $request->detail,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]);
            toastr()->success('Thêm công việc thành công');
        } else {
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
            $check =  Carbon::create($work->start_date)->diffInMinutes(Carbon::create($work->end_date), false);

            if ($check <= 0) {
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
                toastr()->success('Thêm ');
            }
        }
        return redirect()->route('work.index');





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
        $work = Work::findOrFail($request->id);

        return view('work.edit', compact('work'));
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

        if ($check <= 0) {
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
            $this->workInterface->StoreWork($user->id, $user->name, null, null, null, 'Chưa hoàn thành',);

            return redirect()->route('work.index');
        }





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
