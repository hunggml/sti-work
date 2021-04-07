<?php 
namespace App\Repositories;

interface WorkInterface{

    public function StoreWork($user_id,$user_name,$detail,$start,$end,$status,$check,$progress,$hidden);
    public function UpdateWork($id,$detail,$start_date,$end_date,$status,$check,$progress,$hidden);
}