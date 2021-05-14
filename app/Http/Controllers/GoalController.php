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

// ここから検索機能

    // public function search(Request $request)
    // {
    //     $query = Goal::query()->orderBy('id', 'desc');

    //     $query->where('completed','=', $request->completed);
    //     if(isset($request->content)){
    //         $query->where('content','like', "%".$request->content."%");
    //     }

    //     $data = $query->get();
    //     return $data;
    // }

    public function search(Request $request){
        // ゴールの全てのデータを取得
        $querys = Goal::query()->orderBy('id', 'desc'); 
        // リレーション
        foreach($querys as $query){
            $query->users_name = User::find($query->users_id)->name;
        }

        // // contentの検索
        if( $request["content"] != "" ){
            $querys->where('content','like', "%".$request->content."%");
        }
        // // completedの検索
        if($request->completed == true){
            $querys->where('completed','=', 1);
        }else{
            $querys->where('completed','=', 0);
        }
        // users_idの検索



        $data = $querys->get();
        return $data;
    
    }
}
