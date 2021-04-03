<?php 
namespace App\Repositories;

interface UserInterface{

    public function StoreUser($name,$username,$password,$level,$time_created,$time_updated);
}