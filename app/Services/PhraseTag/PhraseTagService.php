<?php
namespace App\Services\PhraseTag;

use App\PhraseTag;

class PhraseTagService {

    // function getAllLikes($userId, $phrase_id_list){

    //     //whereInで絞り込み
    //     $allLikes = PhraseLike::where("user_id","=",$userId)
    //         ->whereIn("phrase_id",$phrase_id_list)
    //         ->get();
    //         //dd($allLikes);//PhraseLikeのidとphrase_id,user_idの一覧。一回されると追加される
        
    //     //Viewで使いやすいように変換
    //     $likes = [];
    //     foreach($allLikes as $like){
    //         $likes[$like->phrase_id] = $like->liked;
    //     }

    //     return $likes;

    // } 


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

        //$tags = $request->get('phrase_tag');
 
        // //タグを改行で分割
        // $tags = array_unique(array_filter(           //空文字を除去
        //  array_map("trim",explode("\n", $tags))  //改行で分割＆改行コードを除去
        // ));

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