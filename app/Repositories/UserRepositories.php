<?php

namespace App\Repositories;

use App\User;
use App\Repositories\WorkInterface;
use App\Work;
use Illuminate\Support\Facades\Auth;

class UserRepositories implements UserInterface
{
    public function deleteUser(){
        return Work::delete([

        ]);
    }
}
