<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    //
    protected $table = "phrases";

    //protected $primaryKey = 'phrase_id';

    protected $fillable = ['phrase','user_id'];

    // public function getLists()
    // {
    //     $phrasePluck = Phrase::pluck('phrase','user_id','phrase_category_id','phrase_tag_id');

    //     return $phrasesPluck;
    // }

    /**
     * RelashinShip
     */
    
    public function user(){
        return $this->belongsTo("App\User");
    }

    public function phraseCategories(){

        return $this->belongsToMany(
          "App\PhraseCategory",	//対象モデル
          "rel_phrase_category",	//中間テーブル
          "phrase_id",			//中間テーブル内での（自分の）IDと連携するカラム
          "phrase_category_id"		//中間テーブル内での（相手の）IDと連携するカラム
        );
    }

    public function words(){
        return $this->hasMany("App\Word");//対象モデル
    }

    public function phraseTags(){

        return $this->belongsToMany(
          "App\PhraseTag",	//対象モデル
          "rel_phrase_tag",	//中間テーブル
          "phrase_id",	    //中間テーブル内での（自分の）IDと連携するカラム
          "phrase_tag_id"		//中間テーブル内での（相手の）IDと連携するカラム
        );
    }

    // public function getTagsAttribute($value)
    //     {
    //         return explode(',', $value);
    //     }

    //     public function setTagsAttribute($value)
    //     {
    //         $this->attributes['tags'] = implode(',', $value);
    //     }

    public function likes(){
      return $this->hasMany('App\PhraseLike');
    }

}