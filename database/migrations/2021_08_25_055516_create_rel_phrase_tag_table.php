<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelPhraseTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_phrase_tag', function (Blueprint $table) {
            $table->id();

            $table->foreignId('phrase_id')
				->constrained('phrases')
				->onDelete('cascade');

			$table->foreignId('phrase_tag_id')
				->constrained('phrase_tags')
				->onDelete('cascade');

            $table->timestamps();
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_phrase_tag');
    }
}
