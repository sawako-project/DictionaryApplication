<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhraseLike extends Model
{
    //
    protected $table = "phrase_likes";

    protected $fillable = ['user_id','phrase_id','liked'];
   
    
    public function phrase(){
        return $this->belongsTo('App\Phrase');
    }

    public function user(){
        return $this->belongsTo("App\User");
    }
    
}
