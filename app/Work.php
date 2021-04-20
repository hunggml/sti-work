<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Work extends Model
{
    //
    use Notifiable;
    use SoftDeletes;
    Const CREATED_AT = 'time_created';
    Const UPDATED_AT = 'time_updated';

    protected $table = 'works';
    // protected $dates = 'deleted_at';
    protected $fillable = [
        'id','user_id','user_name','detail', 'start_date', 'end_date', 'status','check','progress','hidden',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function workHistoryEdit(){
        return $this->hasMany('App\WorkHistoryEdit');
    }
}
