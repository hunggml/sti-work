<?php

namespace App\Repositories;

use App\Work;
use App\Repositories\WorkInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class WorkRepositories implements WorkInterface
{

    public function StoreWork($user_id, $user_name, $detail, $start, $end, $status,$check,$progress,$hidden)
    {
        return Work::create([
                'user_id' => $user_id,
                'user_name' => $user_name,
                'detail' => $detail,
                'start_date' => $start, 
                'end_date' => $end,
                'status' => $status,
                'check' => $check,
                'progress' => $progress,
                'hidden' => $hidden,
        ]); 
    }
    
    public function UpdateWork($id,$detail,$start_date,$end_date,$status,$check,$progress,$hidden){
        return DB::table('works', $id)->where('id', $id)->update([
                'detail' => $detail,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => $status,
                'check' => $check,
                'progress' => $progress,
                'hidden' => $hidden,
            ]);
    }

    public function check() {
        $works = Work::Where('user_id', Auth::user()->id)->get();
        foreach ($works as $work) {
            if ($work->detail == null) {
               return $work->id;
            }
        }
        return false;
    }

    


    
}
