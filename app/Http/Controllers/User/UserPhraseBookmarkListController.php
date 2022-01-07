<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use DB;
use App\Phrase;
use App\PhraseCategory;
use App\BaseCategory;
use App\BaseCategoryMaster;
use App\PhraseTag;
use App\Word;
use App\PhraseLike;
use App\Services\PhraseLike\PhraseLikeService;//getAllLikes($userId, $phrase_id_list) return $likes;


class UserPhraseBookmarkListController extends Controller
{
    //
    public function index(Request $request,PhraseLikeService $phraseLikeService)//,$id
    {

        $phraseCategory_id = $request->input("c");

        if($phraseCategory_id){

            $phraseLikes = Phrase::whereHas('likes', function($query){
                $query->where('liked', 1)->where('user_id','=',Auth::id());
            })
            ->whereHas('phraseCategories', function($query) use($phraseCategory_id) {
                $query->where("phrase_category_id", $phraseCategory_id);
            })
            ->orderBy("id", "desc")
            ->paginate(10);//->get();

            return view('user.user_bookmark_list', compact('phraseLikes'));
        }

        $phraseTag_id = $request->input("t");

        if($phraseTag_id){

            $phraseLikes = Phrase::whereHas('likes', function($query){
                $query->where('liked', 1)->where('user_id','=',Auth::id());
            })
            ->whereHas("phraseTags", function($query) use($phraseTag_id) {
				$query->where("phrase_tag_id", $phraseTag_id);
			})
            ->orderBy("id", "desc")
            ->paginate(10);//->get();

            return view('user.user_bookmark_list', compact('phraseLikes'));
        }
  
        //likesテーブルでの条件に一致するphraseを取得
        $phraseLikes = Phrase::whereHas('likes', function($query){
            $query->where('liked', 1)->where('user_id','=',Auth::id());
        })
        ->orderBy("id", "desc")
        ->paginate(10);//get();

        //likesテーブルに入っているphrase_idを
        $phraseIdList = $phraseLikes->map(function($like){
            return $like->phrase_id;
        });

        ///////////////////////////////////////////////////

        //"phrase_id",$phraseIdListを絞り込み
        // $allLikes = PhraseLike::where("user_id","=",Auth::id())
        //         ->whereIn("phrase_id",$phraseIdList)
        //         ->get();
            
        //     //Viewで使いやすいように変換
        //     $likes = [];
        //     foreach($allLikes as $like){
        //         $likes[$like->phrase_id] = $like->liked;
        //     }
        
        ////////////////////////////////////////////////////

        $likes = $phraseLikeService->getAllLikes(Auth::id(), $phraseIdList);

        return view('user.user_bookmark_list',[
            "phraseLikes" => $phraseLikes,
            "likes" => $likes
        ]);

    }

}