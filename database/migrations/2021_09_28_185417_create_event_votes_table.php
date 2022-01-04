<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_votes', function (Blueprint $table) {
            $table->id();
            $table->boolean('vote');
            $table->integer('unuser_id')->nullable();
            $table->foreignId('user_id')->constraind("users")->onDelete('cascade')->nullable();
            $table->foreignId('event_id')->constraind("events")->onDelete('cascade')->nullable();
            $table->foreignId('event_post_id')->constraind("event_posts")->onDelete('cascade')->nullable();

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
        Schema::dropIfExists('event_votes');
    }
}
