<?php
namespace App\Services\PhraseTag;

use App\PhraseTag;

class PhraseTagService {


    function phraseTagWhitelist(){

        $phraseTags = PhraseTag::all();
        
        //PHP側で取り出したいキーの配列を文字列化します。
        $whitelist = '';
        foreach ($phraseTags as $key => $value) {
        $whitelist .= ','.$value['phrase_tag'];
        }
        $whitelist = substr($whitelist,1);

        return array($phraseTags, $whitelist);

    }    

    function phraseTagJsonDecode($tags){

        
        //tagfyでJSON形式になっている
        $tags = json_decode($tags, true);
            
        $tagList = [];

        if(is_array($tags)) foreach($tags as $tagItem){
            $tagLabel = $tagItem["value"];
  
            $tag = PhraseTag::where("phrase_tag", $tagLabel)->first();
            if(!$tag){
                $tag = PhraseTag::create(["phrase_tag" => $tagLabel]);
            }
            $tagList[] = $tag->id;
        }

        //return array($tags, $tagList);
        return $tagList;
    }

}