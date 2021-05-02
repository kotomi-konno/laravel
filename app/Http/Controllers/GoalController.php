<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goal;
use App\User;


class GoalController extends Controller
{
    public function create(Request $request)
    {
        // return $request->completed;
        Goal::create([
            'users_id' => $request->users_id,
            'content' => $request->content,
            'deadline' => $request->deadline,
            'time' => $request->time,
            'completed' => $request->completed,
        ]);
    }

       
    public function read()
    {
        // 降順に表示させる
        //    return Goal::get(); でもいいよ！！
       $datas = Goal::orderBy('created_at', 'desc')->get();
        //   ↓リレーション
       foreach($datas as $data){
           $data->users_name = User::find($data->users_id)->name;
       }
       return $datas;
        // return User::find($data->users_id);
    }

    public function update(Request $request)
    {
        Goal::where("id", $request->id)->update([
            'users_id' => $request->users_id,
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

    public function search(Request $request)
    {
        $query = Goal::query()
        ->orderBy('id', 'desc');

        $query->where('completed','=', $request->completed);
        if(isset($request->content)){
            $query->where('content','like', "%".$request->content."%");
        }

        $data = $query->get();
        return $data;
    }
}
