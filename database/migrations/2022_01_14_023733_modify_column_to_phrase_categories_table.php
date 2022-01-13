<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnToPhraseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phrase_categories', function (Blueprint $table) {
            //
            $table->dropColumn('phrase_category_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phrase_categories', function (Blueprint $table) {
            //
            $table->string('phrase_category_name')->nullable();
         
        });
    }
}
