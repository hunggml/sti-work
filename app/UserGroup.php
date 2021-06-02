<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    
    use Notifiable;
    use SoftDeletes;
    Const CREATED_AT = 'time_created';
    Const UPDATED_AT = 'time_updated';

    protected $table = 'user_group';
    protected $fillable = [
        'user_id','group_id'
    ];

        
}
