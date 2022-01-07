<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PhraseSeeder::class);
        //$this->call('PhraseCategorySeeder');
        //$this->call('UserSeeder');
    }
}
