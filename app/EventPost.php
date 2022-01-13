<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    
    protected $table = "event_posts";

    protected $fillable = ['post_text'];//'user_id','event_id'

    function user(){
        //return $this->hasOne("App\User");//->withDefault()
        return $this->belongsTo("App\User");
    }

    function event(){
        return $this->belongsTo("App\Event");
    }

    function votes(){
        return $this->hasMany("App\EventVote");
    }

    function phrase(){
        //return $this->hasOne("App\Phrase");
        return $this->belongsTo("App\Phrase");
    }

    function isClosed(){

        $end = strtotime($this->event->schedule_end);
        if(time() > $end){
            return true;
        }
        
        return false;
    }

    // function createPhrase(Event $event){

    //     //phraseがあればスルー
    //     if($this->phrase){
    //         return;
    //     }
         
    //     //phraseがなければ作成
    //     $phrase = new Phrase([
    //         "user_id" => $this->user_id,
    //         "phrase" => $this->post_text,
    //     ]);
    //     $phrase->save();

        
    //     //イベントの名前でタグを自動で作って割り当てる
    //     $tagLabel = "Event:" . $event->event_text;

    //     //tagがあれば取得
    //     $tag = PhraseTag::where("phrase_tag", $tagLabel)->first();//PhraseTagのphrase_tagと参照
    //     //tagがなければ作成
    //     if(!$tag){
    //         $tag = PhraseTag::create(["phrase_tag" => $tagLabel]);//PhraseTagのphrase_tagに入れる
    //     }

    //     //PhraseTagのphrase_tagとして更新
    //     $tagList = [];
    //     $tagList[] = $tag->id;
    //     $phrase->phraseTags()->attach($tagList);

    //     //連携
    //     $this->phrase_id = $phrase->id;
    //     $this->save();
    // }
    
}
