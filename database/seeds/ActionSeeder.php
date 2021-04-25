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
        for ($i = 1; $i <= 10; $i++) {
            Action::create([
                'users_id' => $i%3 +1,
                'goals_id' => $i%2 +1,
                'done_date' => "2021-04-25",
                'done_time' => '6:00:00',
            ]);
        }
    }
}
