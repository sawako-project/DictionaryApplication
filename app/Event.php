<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";

    protected $fillable = ['event_text','event_type'];//'user_id','schedule_end'

    function user(){
        //return $this->hasOne("App\User");//->withDefault()
        return $this->belongsTo("App\User");
    }
   
    function posts(){
        return $this->hasMany("App\EventPost");
    }

    //イベントの締切
    function isClosed(){
    
        $end = strtotime($this->schedule_end);
        if(time() > $end){
            return true;
        }
        
        return false;
    }

    function eventLabel(){

        $master = EventTypeMaster::getMaster($this->event_type);
        
        if(!$master)return "Unknown";

        return $master->label;
    }

}