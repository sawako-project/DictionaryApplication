<?php
namespace App\Services\PhraseLike;

use App\PhraseLike;

class PhraseLikeService {

    function getAllLikes($userId, $phrase_id_list){

        $allLikes = PhraseLike::where("user_id","=",$userId)
            ->whereIn("phrase_id",$phrase_id_list)
            ->get();
        
        //Viewで使いやすいように変換
        $likes = [];
        foreach($allLikes as $like){
            $likes[$like->phrase_id] = $like->liked;
        }

        return $likes;

    }    

}