<?php

use Illuminate\Database\Seeder;
use App\Action;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Action::create([
                'users_id' => $i,
                'goals_id' => $i,
                'done_date' => "2021-05-".$i,
                'done_time' => '6:00:00',
                'memo' => 'これはメモです。あなたはここに活動に関するメモを残すことができます。例えば、AWSにデプロイができた、などです。',
            ]);
        }
    }
}
