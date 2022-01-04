<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventVote extends Model
{
    //
    protected $table = "event_votes";

    protected $fillable = ['vote'];

    function event(){
        return $this->belogsTo("App\Event");
    }

    function post(){
        return $this->belogsTo("App\EventPost");
    }

}
