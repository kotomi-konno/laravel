<?php

// シーダーはダミーデータを入れてるよ！

use Illuminate\Database\Seeder;
use App\Goal;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
                Goal::create([
                    'name' => '名前'.$i,
                    'content' => '目標の内容' . $i,
                    'deadline' => '2021-04-30',
                    'time' => '30:00:00',
                    'completed' => false
                ]);
            }
    }
}
