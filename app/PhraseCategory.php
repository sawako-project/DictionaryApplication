<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhraseCategory extends Model
{
    //
    protected $table = "phrase_categories";

    //protected $primaryKey = 'phrase_category_id';

    protected $fillable = ['phrase_category'];
   
    // public function getLists()
    // {
    //     $phraseCategoryPluck = PhraseCategory::pluck('phrase_category','user_id','phrase_id','phrase_tag_id');//'id',
        
    //     return $phraseCategoryPluck;
    // }

    public function baseCategories(){
        return $this->hasMany("App\BaseCategory");
    }

    public function phrases(){
        
		return $this->belongsToMany(
			"App\Phrase",	//対象モデル
			"rel_phrase_category",	//中間テーブル
			"phrase_category_id",			//中間テーブル内での（自分の）IDと連携するカラム
			"phrase_id"		//中間テーブル内での（相手の）IDと連携するカラム
		);
	}

}


