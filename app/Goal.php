<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{

   protected $fillable = [
           'users_id',
           'content',
           'deadline',
           'time',
           'completed',
    ];


    public function user(){
        return $this -> belongsTo('App\User');
    }
    public function actions(){
        return $this->hasMany('App\Action');
    }
    
    
}
