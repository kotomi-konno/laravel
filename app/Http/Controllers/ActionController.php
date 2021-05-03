<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\User;
use App\Goal;

class ActionController extends Controller
{

    public function create(Request $request)
    {
        Action::create([
            'done_date' => $request->done_date,
            'done_time' => $request->done_time,
            'users_id' => $request->users_id,
            'goals_id' => $request->goals_id,
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
    }
}
