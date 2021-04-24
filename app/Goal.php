<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{

   protected $fillable = [
           'users_id',
        //    'name',
           'content',
           'deadline',
           'time',
           'completed',
    ];

    // protected $table = 'goals';

    public function user(){
        return $this -> belongsTo('App\User');
    }
    
}
