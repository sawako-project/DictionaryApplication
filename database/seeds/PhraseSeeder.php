<?php

use Illuminate\Database\Seeder;

class PhraseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phrases = [
             ['id' => 96, 'phrase' => '足を滑らせる'],
             ['id' => 97, 'phrase' => '衣類を纏う'],
             ['id' => 98, 'phrase' => '足で遠ざける'],
             ['id' => 99, 'phrase' => 'ペンを走らせる'],
             ['id' => 100, 'phrase' => '耳を傾ける'],
         ];
        DB::table('phrases')->insert($phrases);
        //DB::table('users')->truncate(); // 既存のユーザを削除
        // factory(User::class, 20)->create();
        // factory(User::class, 10)->states('admin')->create();
        // factory(User::class, 100)->states('general')->create();
    
    }
}
