<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goal;


class GoalController extends Controller
{
    public function create(Request $request)
    {
        // return $request->completed;
        Goal::create([
            'name' => $request->name,
            'content' => $request->content,
            'deadline' => $request->deadline,
            'time' => $request->time,
            'completed' => $request->completed,
        ]);
    }

       public function read()
    {
        // 降順に表示させる
       $data = Goal::orderBy('created_at', 'desc')->get();
       return $data;

    //    return Goal::get(); でもいいよ！！
    }
       public function update(Request $request)
    {
        Goal::where("id", $request->id)->update([
            'name' => $request->name,
            'content' => $request->content,
            'deadline' => $request->deadline,
            'time' => $request->time,
            'completed' => $request->completed,
        ]);
    }
        public function delete($id)
    {
        Goal::where("id", $id)->delete();
    }
}
