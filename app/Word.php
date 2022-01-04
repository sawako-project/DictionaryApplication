<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //
    protected $table = "words";

    protected $fillable = ['word'];

    public function phrases(){
        return $this->belongsTo("App\Phrase");
    }
}
