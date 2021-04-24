<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    
   protected $fillable = [
           'name',
           'content',
           'deadline',
           'time',
           'completed',
           'users_id',
    ];

    // protected $table = 'goals';

    public function user(){
        return $this -> belongsTo('App\User');
    }
    
}
