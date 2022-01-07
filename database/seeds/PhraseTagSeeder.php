<?php

use Illuminate\Database\Seeder;

class PhraseTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $phrase_tags = [
            // ['id' => 1, 'phrase_tags' => ''],
            // ['id' => 2, 'phrase_tags' => ''],
            // ['id' => 3, 'phrase_tags' => ''],
        ];
        
        DB::table('phrase_tags')->insert($phrase_tags);
    }
}
