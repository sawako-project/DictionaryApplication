<?php

use Illuminate\Database\Seeder;


class PhraseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $phrase_categories = [
           // ['id' => 1, 'phrase_category' => '笑う'],
            //['id' => 2, 'phrase_category' => '食べる'],
            //['id' => 3, 'phrase_category' => '泣く'],
            // ['id' => 6, 'phrase_category' => '座る'],
            // ['id' => 7, 'phrase_category' => '怒る'],
            // ['id' => 8, 'phrase_category' => '歩く'],
            // ['id' => 9, 'phrase_category' => '走る'],
            // ['id' => 10, 'phrase_category' => '寝る'],
            ['id' => 14, 'phrase_category' => '書く'],
            ['id' => 15, 'phrase_category' => '聞く'],
            ['id' => 16, 'phrase_category' => '起きる'],
            ['id' => 17, 'phrase_category' => '着る'],
            ['id' => 18, 'phrase_category' => '蹴る'],
            ['id' => 19, 'phrase_category' => '転ぶ'],
            ['id' => 20, 'phrase_category' => '叩く'],//(人を)(ドアを)
            ['id' => 21, 'phrase_category' => '立つ'],
            ['id' => 22, 'phrase_category' => '掴む'],
            ['id' => 23, 'phrase_category' => '摘む'],
        ];
        DB::table('phrase_categories')->insert($phrase_categories);
        //DB::table('users')->truncate(); // 既存のユーザを削除
        // factory(User::class, 20)->create();
        // factory(User::class, 10)->states('admin')->create();
        // factory(User::class, 100)->states('general')->create();
    }
}
