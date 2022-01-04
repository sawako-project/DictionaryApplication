<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelPhraseCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_phrase_category', function (Blueprint $table) {
            $table->id();

            $table->foreignId('phrase_id')
				->constrained('phrases')
				->onDelete('cascade');

			$table->foreignId('phrase_category_id')
				->constrained('phrase_categories')
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
        Schema::dropIfExists('rel_phrase_category');
    }
}
