<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class WorkHistoryEdit extends Model
{
      //
      use Notifiable;
      use SoftDeletes;
      Const CREATED_AT = 'time_created';
      Const UPDATED_AT = 'time_updated';
  
      protected $table = 'work_history_edit';
      // protected $dates = 'deleted_at';
      protected $fillable = [
          'work_id','detail','start_date','end_date','status'
      ];
  
  
      public function work(){
          return $this->belongsTo('App\Work');
      }
}
