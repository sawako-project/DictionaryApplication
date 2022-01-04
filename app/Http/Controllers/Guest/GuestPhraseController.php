<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\User;

use App\Phrase;
use App\PhraseCategory;
use App\BaseCategory;
use App\BaseCategoryMaster;
use App\PhraseTag;
use App\Word;
use App\PhraseLike;
use App\Services\PhraseLike\PhraseLikeService;//getAllLikes($userId, $phrase_id_list) return $likes;

//ユーザー認証していたらそのまま使える

class GuestPhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req,PhraseLikeService $phraseLikeService)
    {
        
        $phraseTag_id = $req->input("t");
        if($phraseTag_id){

            $phrases = Phrase::whereHas("phraseTags", function($query) use($phraseTag_id) {
				
				//ここはPharseTagの絞り込み条件を書く
				$query->where("phrase_tag_id", $phraseTag_id);

			})->orderBy("id", "desc")->paginate(10);//->get();

            return view('guest.phrases.index', compact('phrases'));
        }
  
        $phrases = Phrase::orderBy('id','desc')->paginate(10);//->get();
        //$likes = $this->getLikes($phrases);
        //////////////////////////////////

        //Serviceにて共通化
        $phrase_id_list = [];
        foreach($phrases as $phrase){
            $phrase_id_list[] = $phrase->id;
        }
        $likes = $phraseLikeService->getAllLikes(Auth::id(),$phrase_id_list);

        //////////////////////////////////

        return view('guest.phrases.index', compact('phrases','likes'));
    }

    public function show(Request $request,$id)
    {
        $phrase = Phrase::find($id);
        if(!$phrase){
            return back()->withError("これはだめだ");//return redirect()?
        }
        
        //Likeの取得
        $like = PhraseLike::where("user_id","=",Auth::id())
        ->where("phrase_id","=",$phrase->id)->first();

        return view('guest.phrases.show',[
            'phrase' => $phrase,
            "like" => $like,
            "editable" => $phrase->user_id == Auth::id()
        ]);
    }

    public function category(Request $request,$category)
    {

        $category = PhraseCategory::where("phrase_category","=",$category)->first();
        if(!$category){
            return back()->withError("これはだめだ");//return redirect()?
        }

        $phraseCategory_id = $category->id;

        $phrases = Phrase::whereHas("phraseCategories", function($query) use($phraseCategory_id) {
				
            //ここはPharseCategoryの絞り込み条件を書く
            $query->where("phrase_category_id", $phraseCategory_id);

        })->orderBy("id", "desc")->paginate(10);//->get();

        $likes = $this->getLikes($phrases);

        return view('guest.phrases.index', compact('phrases', 'category', 'likes'));
    }

    public function tag(Request $request,$tag)
    {

        $tag = PhraseTag::where("phrase_tag","=",$tag)->first();
        if(!$tag){
            return back()->withError("これはだめだ");//return redirect()?
        }

        $phraseTag_id = $tag->id;

        $phrases = Phrase::whereHas("phraseTags", function($query) use($phraseTag_id) {
				
            //ここはPharseTagの絞り込み条件を書く
            $query->where("phrase_tag_id", $phraseTag_id);

        })->orderBy("id", "desc")->paginate(10);//->get();

        $likes = $this->getLikes($phrases);

        return view('guest.phrases.index', compact('phrases','tag','likes'));

    }

    //
    function getLikes($phrases){

        $phrase_id_list = [];
        foreach($phrases as $phrase){
            $phrase_id_list[] = $phrase->id;
        }
       
        //whereInで絞り込み
        $allLikes = PhraseLike::where("user_id","=",Auth::id())
            ->whereIn("phrase_id",$phrase_id_list)
            ->get();
        //dd($allLikes);//DreamLikeのidとdream_id,user_idの一覧。一回されると追加される

        //Viewで使いやすいように変換
        $likes = [];//空配列つくって
        foreach($allLikes as $like){
            $likes[$like->phrase_id] = $like->liked;
        }

        return $likes;
    }

}
