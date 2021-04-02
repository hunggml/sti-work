<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


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
        'id','name','username','phone','address', 'email', 'password','level'
    ];
    
    public function work(){
        return $this->hasMany('App\Work')->whereStatus('Chưa hoàn thành');
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
