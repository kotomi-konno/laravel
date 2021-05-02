<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\User;
use App\Goal;

class ActionController extends Controller
{
    public function create()
    {
        Action::create([
            'users_id' => $request->users_id,
            'goals_id' => $request->goals_id,
            'done_date' => $request->done_date,
            'done_time' => $request->done_time,
        ]);
    }

    public function read()
    {
        $datas = Action::get();

        foreach($datas as $data){
            // $data->users_name = User::find($data->users_id)->name;
            $data->goals_content = Goal::find($data->goals_id)->content;
        }

        return $datas;
        // return User::find($datas[0]->users_id)->name;
        // return Goal::find($datas[1]->goals_id)->content;
    }
}
