<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'done_date',
        'done_time',
        'users_id',
        'goals_id',
        'memo',
 ];

 public function user(){
    return $this -> belongsTo('App\User');
}
public function goal(){
    return $this -> belongsTo('App\Goal');
}


}
