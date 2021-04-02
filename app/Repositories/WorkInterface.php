<?php 
namespace App\Repositories;

interface WorkInterface{

    public function StoreWork($user_id,$user_name,$detail,$start,$end,$status,$check);

    public function check();
}