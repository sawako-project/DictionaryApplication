<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhraseTag extends Model
{
    //
    protected $table = "phrase_tags";

    protected $fillable = ['phrase_tag'];
   
    // public function getLists()
    // {
    //     $phraseTagPluck = PhraseTag::pluck('phrase_tag','user_id','phrase_id','phrase_category_id');//'id',
        
    //     return $phraseTagPluck;
    // }

    /**
     * RelashinShip
     */

    public function phrases(){
      
        return $this->belongsToMany(
          "App\Phrase",	    //対象モデル
          "rel_phrase_tag",	//中間テーブル
          "phrase_tag_id",	//中間テーブル内での（自分の）IDと連携するカラム
          "phrase_id"		    //中間テーブル内での（相手の）IDと連携するカラム
        );
    }

}