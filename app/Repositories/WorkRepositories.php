<?php

namespace App\Repositories;

use App\Work;
use App\Repositories\WorkInterface;
use Illuminate\Support\Facades\Auth;


class WorkRepositories implements WorkInterface
{

    public function StoreWork($user_id, $user_name, $detail, $start, $end, $status)
    {

        // dd(Work::create([
        //     'user_id' => $user_id,
        //     'user_name' => $user_name,
        //     'detail' => $detail,
        //     'start_date' => $start,
        //     'end_date' => $end,
        //     'status' => $status,
        // ]));
        return Work::create([
            'user_id' => $user_id,
            'user_name' => $user_name,
            'detail' => $detail,
            'start_date' => $start,
            'end_date' => $end,
            'status' => $status,
        ]);
    }

    public function update(){
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
