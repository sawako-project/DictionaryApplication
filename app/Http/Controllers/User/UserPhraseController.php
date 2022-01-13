<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Phrase;
use App\PhraseCategory;
use App\BaseCategory;
use App\BaseCategoryMaster;
use App\PhraseTag;
use App\Word;

use App\PhraseLike;

use App\Services\PhraseTag\PhraseTagService;

class UserPhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(Request $req)
    {
        
        $phraseCategory_id = $req->input("c");
        if($phraseCategory_id){

            $phrases = Phrase::whereHas("phraseCategories", function($query) use($phraseCategory_id) {
				
				//ここはPharseCategoryの絞り込み条件を書く
				$query->where("phrase_category_id", $phraseCategory_id);

			})->where('user_id','=', Auth::id())->orderBy("id", "desc")->paginate(10);//->get();

            return view('user.phrases.index', compact('phrases'));
        }

        $phraseTag_id = $req->input("t");
        if($phraseTag_id){

            $phrases = Phrase::whereHas("phraseTags", function($query) use($phraseTag_id) {
				
				//ここはPhraseTagの絞り込み条件を書く
				$query->where("phrase_tag_id", $phraseTag_id);

			})->where('user_id','=', Auth::id())->orderBy("id", "desc")->paginate(10);//->get();

            return view('user.phrases.index', compact('phrases'));
        }
  
        $phrases = Phrase::where('user_id','=', Auth::id())
            ->orderBy('id','desc')
            ->paginate(10);//->get();
        return view('user.phrases.index', compact('phrases'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req,PhraseTagService $phraseTagService)//(Request $req)
    {

        $phraseCategories = PhraseCategory::all();
        
        //初期値
        $category_ids = $req->input("category_id", []);

        //////////////////////////////////////////////
        // $phraseTags = PhraseTag::all();

        //    //$tagList = $phrase->phraseTags()->pluck("phrase_tag")->toArray();

        //    //PHP側で取り出したいキーの配列を文字列化します。
        //     $whitelist = '';
        //     foreach ($phraseTags as $key => $value) {

        //      $whitelist .= ','.$value['phrase_tag'];
        //     }
        //     $whitelist = substr($whitelist,1);

        //    //@TODO
        // //    $whitelist = [
        // //        "未分類","プラス","マイナス"
        // //    ];
        //////////////////////////////////////////////
        list($phraseTags, $whitelist) = $phraseTagService->phraseTagWhitelist();
        //$phraseTags = $phraseTags;
        //$whitelist= $whitelist;

        return view('user.phrases.create', compact('phraseCategories','phraseTags','whitelist','category_ids'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,PhraseTagService $phraseTagService)//(Request $request)
    {
        $request->validate([
            'phrase'=>'required',
            'phrase_category'=>'required',
            'phrase_tag'=>'nullable'
        ]);

        $phrase = new Phrase();
        $phrase->phrase = $request->get('phrase');
        $phrase->user_id = Auth::id();
        $phrase->save();

        //phrase_category
        $phrase_category_id = $request->get('phrase_category');
        $phrase->phraseCategories()->attach($phrase_category_id);

        //phrase_tag
        ///////////////////////////////////////////////

        // // textareaならこっち
        // // $phraseTag = new PhraseTag();
        // // $phraseTag->phrase_tag = $request->get('phrase_tag');
        // // $phraseTag->save();

        // //    $phraseTag = $request->get('phrase_tag');
        // //    $phrase->phraseTags()->attach($phraseTag);

        // $tags = $request->get('phrase_tag');

        // //タグを改行で分割
        // // $tags = array_unique(array_filter(			//空文字を除去
		// // 	array_map("trim",explode("\n", $tags))	//改行で分割＆改行コードを除去
		// // ));

        // //tagfyでJSON形式になっている
        // $tags = json_decode($tags, true);

        // $tagList = [];
        // if(is_array($tags)){
        //     foreach($tags as $tagItem){
        //         $tagLabel = $tagItem["value"];
        //         $tag = PhraseTag::where("phrase_tag", $tagLabel)->first();
        //         if(!$tag){
        //             $tag = PhraseTag::create(["phrase_tag" => $tagLabel]);
        //         }
        //         $tagList[] = $tag->id;
        //     }
        // }
        // $phrase->phraseTags()->attach($tagList);
        // //$phrase->phraseTags()->sync($tags);
        
        // // if()checkboxならこっち
        // //$phrase_tag_id = $request->get('phrase_tag');//
        // //$phrase->phraseTags()->attach($phrase_tag_id);

        ///////////////////////////////////////////
        $tags = $request->get('phrase_tag');
        // $tags = json_decode($tags, true);❗️

        // list($tags, $tagList) = $phraseTagService->phraseTagJsonDecode();
        // $tags = $tags;
        // $tagList= $tagList;

        $tagList = $phraseTagService->phraseTagJsonDecode($tags);//
        // $tags = $tags;
        // $tagList= $tagList;

        $phrase->phraseTags()->attach($tagList);

        return redirect()->route("user.phrase.index")->with('success', 'saved!');
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    //     $phrase = Phrase::find($id);
        
    //     if(!$phrase){
    //         return back()->withError("これはだめだ");//return redirect()?
    //     }
        
    //     //Likeの取得
    //     $like = PhraseLike::where("user_id","=",Auth::id())
    //     ->where("phrase_id","=",$phrase->id)->first();

    //     return view('user.phrases.show',[
    //         'phrase' => $phrase,
    //         "like" => $like,
    //         "editable" => $phrase->user_id == Auth::id()
    //     ]);
    
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,PhraseTagService $phraseTagService)//($id)
    {
        $phrase = Phrase::find($id);

        if($phrase->user_id != Auth::id()){
            return redirect()->route("user.phrase.index");
        }

        $phraseCategories = PhraseCategory::all();
        $selected_categories = $phrase->phraseCategories->pluck("id")->toArray();//()?
        $baseCategoryLabels = BaseCategoryMaster::labels();

        //////////////////////////////////////////////////
        // $phraseTags = PhraseTag::all();
        // $tagList = $phrase->phraseTags()->pluck("phrase_tag")->toArray();

        // //PHP側で取り出したいキーの配列を文字列化します。
        // $whitelist = '';
        // foreach ($phraseTags as $key => $value) {
        //     $whitelist .= ','.$value['phrase_tag'];
        // }
        // $whitelist = substr($whitelist,1); 

        // //         @TODO
        // //          $whitelist = [
        // //              "未分類","プラス","マイナス",
        // //          ];
        // //         foreach ($phraseTags as $pt) {
        // //            // $ptList = $pt->phrase_tag;
        // //             $list = $pt;
        // //         }

        //         //$whitelist = $phraseTags;

        //////////////////////////////////////////////////

        list($phraseTags, $whitelist) = $phraseTagService->phraseTagWhitelist();
        // $phraseTags = $phraseTags;
        // $whitelist= $whitelist;

        $tagList = $phrase->phraseTags()->pluck("phrase_tag")->toArray();

        return view('user.phrases.edit', compact('phrase', 'phraseCategories', 'selected_categories', 'baseCategoryLabels', 'tagList', 'whitelist','phraseTags'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,PhraseTagService $phraseTagService)//(Request $request, $id)
    {

        $phrase = Phrase::find($id);

        if($phrase->user_id != Auth::id()){
            return redirect()->route("user.phrase.index");
        }

        $request->validate([
            'phrase'=> ['required','string','max:300'],
            'phrase_category' => 'required',
            'phrase_tag' => 'nullable|string'
        ]);

        $phrase->phrase = $request->get('phrase');
        $phrase->save();

        //sync categories        
        $checked_categories = $request->get("phrase_category");
        $phrase->phraseCategories()->sync($checked_categories);

        //$phrase->categories()->save();
        //$phrase->categories()->sync($checked_categories);
        //$phrase->categories()->syncWithoutDetaching($checked_categories);

        //////////////////////////////////////////////////////

        // $tags = $request->get('phrase_tag');

        // //タグを改行で分割
        // // $tags = array_unique(array_filter(			//空文字を除去
		// // 	array_map("trim",explode("\n", $tags))	//改行で分割＆改行コードを除去
		// // ));

        // //tagfyでJSON形式になっている
        // $tags = json_decode($tags, true);
        
        // $tagList = [];
        // if(is_array($tags)) foreach($tags as $tagItem){
        //     $tagLabel = $tagItem["value"];

        //     $tag = PhraseTag::where("phrase_tag", $tagLabel)->first();
        //     if(!$tag){
        //         $tag = PhraseTag::create(["phrase_tag" => $tagLabel]);
        //     }
        //     $tagList[] = $tag->id;
        // }
        // $phrase->phraseTags()->sync($tagList);

        //////////////////////////////////////////////////
        $tags = $request->get('phrase_tag');
        //$tags = json_decode($tags, true);❗️
        // list($tags, $tagList) = $phraseTagService->phraseTagJsonDecode();
        // $tags = $tags;
        // $tagList= $tagList;

        $tagList = $phraseTagService->phraseTagJsonDecode($tags);
        $phrase->phraseTags()->sync($tagList);
                
        return redirect()->route("user.phrase.index")->with('success', 'saved!');
    }

    /**
     * Remove the specifi//ed resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phrase = Phrase::find($id);
        if($phrase->user_id != Auth::id()){
            return redirect()->route("user.phrase.index");
        }

        Phrase::find($id)->delete();
        
        return redirect()->route("user.phrase.index")->with('success', 'deleted!');
    }
    
}