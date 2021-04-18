<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
                User::create([
                    // 開発中は、初期ログインのためにこの表記を入れておく
                    'name' => 'kotomi',
                    'email' => 'kotomi.okawa@gmail.com',
                    'password' => \Hash::make('test1234'),
                ]);
                factory(User::class, 30)->create();
            }
    }
}
