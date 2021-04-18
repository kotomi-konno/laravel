<?php

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
                    'name' => '名前番号' . $i,
                    'content' => '目標の内容' . $i,
                    'target_time' => '3:00:00',
                ]);
            }
    }
}
