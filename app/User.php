<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    Const CREATED_AT = 'time_created';
    Const UPDATED_AT = 'time_updated';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $dates = 'deleted_at';

    protected $fillable = [
        'name','username','phone','address', 'email', 'password','level','group_id','metting','progress','image','date_work'
    ];
    
    public function work(){
        return $this->hasMany('App\Work');
    }


    public function group(){
        return $this->belongsToMany('App\Group','user_group','user_id','group_id')->wherePivot('deleted_at',null);
    }


    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
