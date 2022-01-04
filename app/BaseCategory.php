<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseCategory extends Model
{   
    public function phraseCategory(){
        return $this->belongsTo("App\PhraseCategory");
    }
}

