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
        User::create([
            // 開発中は、初期ログインのためにこの表記を入れておく
            'name' => 'kotomi',
            'email' => 'kotomi.okawa@gmail.com',
            'password' => \Hash::make('test1234'),
            'level' => '2',
        ]);
        factory(User::class, 5)->create();
    }
}
