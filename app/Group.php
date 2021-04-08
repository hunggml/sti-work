<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use Notifiable;
    use SoftDeletes;
    Const CREATED_AT = 'time_created';
    Const UPDATED_AT = 'time_updated';

    protected $table = 'groups';
    protected $fillable = [
        'name'
    ];


    public function user(){
        return $this->hasMany('App\User');
    }
}
