<?php 
namespace App\Repositories;

interface UserInterface{

    public function StoreUser($name,$username,$password,$level,$group_id,$metting,$progress,$time_created,$time_updated);
}