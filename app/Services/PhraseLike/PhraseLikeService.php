<?php
namespace App\Services\PhraseLike;

use App\PhraseLike;

class PhraseLikeService {

    function getAllLikes($userId, $phrase_id_list){

        //whereInで絞り込み
        $allLikes = PhraseLike::where("user_id","=",$userId)
            ->whereIn("phrase_id",$phrase_id_list)
            ->get();
            //dd($allLikes);//PhraseLikeのidとphrase_id,user_idの一覧。一回されると追加される
        
        //Viewで使いやすいように変換
        $likes = [];
        foreach($allLikes as $like){
            $likes[$like->phrase_id] = $like->liked;
        }

        return $likes;

    }    

}
