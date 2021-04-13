<?php

namespace App\Repositories;

use App\User;
use App\Repositories\WorkInterface;
use Illuminate\Support\Facades\Hash;
use App\Work;
use Illuminate\Support\Facades\Auth;

class UserRepositories implements UserInterface
{   
    public function StoreUser($name,$username,$password,$level,$group_id,$metting,$progress,$time_created,$time_updated)
    {
        return User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'level' => $level,
            'group_id' => $group_id,
            'metting' => $metting,
            'progress' => $progress,
            'time_created' => $time_created,
            'time_updated' => $time_updated
        ]);
    }
    
       
}
