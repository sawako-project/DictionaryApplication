<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEventPostsAddPhraseId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_posts', function (Blueprint $table) {
            $table->foreignId('phrase_id')->constraind("phrases")->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_posts', function (Blueprint $table) {
            $table->dropColumn('phrase_id');
        });
    }
}
