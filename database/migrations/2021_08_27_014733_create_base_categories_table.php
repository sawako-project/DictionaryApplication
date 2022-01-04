<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //phrase_categories -> hasMany -> base_categories
        //base_categories -> belongsTo -> phrase_categories
        Schema::create('base_categories', function (Blueprint $table) {
            $table->id();
            $table->string("code");
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
        Schema::dropIfExists('base_categories');
    }
}
