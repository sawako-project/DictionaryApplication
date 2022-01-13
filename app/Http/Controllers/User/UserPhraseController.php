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

			})->where('user_id','=', Auth::id())->orderBy("id", "desc")->paginate(10);

            return view('user.phrases.index', compact('phrases'));
        }

        $phraseTag_id = $req->input("t");
        if($phraseTag_id){

            $phrases = Phrase::whereHas("phraseTags", function($query) use($phraseTag_id) {
				
				//ここはPhraseTagの絞り込み条件を書く
				$query->where("phrase_tag_id", $phraseTag_id);

			})->where('user_id','=', Auth::id())->orderBy("id", "desc")->paginate(10);

            return view('user.phrases.index', compact('phrases'));
        }
  
        $phrases = Phrase::where('user_id','=', Auth::id())
            ->orderBy('id','desc')
            ->paginate(10);
        return view('user.phrases.index', compact('phrases'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req,PhraseTagService $phraseTagService)
    {

        $phraseCategories = PhraseCategory::all();
        
        //初期値
        $category_ids = $req->input("category_id", []);

        list($phraseTags, $whitelist) = $phraseTagService->phraseTagWhitelist();


        return view('user.phrases.create', compact('phraseCategories','phraseTags','whitelist','category_ids'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,PhraseTagService $phraseTagService)
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
        $tags = $request->get('phrase_tag');

        $tagList = $phraseTagService->phraseTagJsonDecode($tags);

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
    //         return back()->withError("エラーが発生しました");//return redirect()
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
    public function edit($id,PhraseTagService $phraseTagService)
    {
        $phrase = Phrase::find($id);

        if($phrase->user_id != Auth::id()){
            return redirect()->route("user.phrase.index");
        }

        $phraseCategories = PhraseCategory::all();
        $selected_categories = $phrase->phraseCategories->pluck("id")->toArray();
        $baseCategoryLabels = BaseCategoryMaster::labels();


        list($phraseTags, $whitelist) = $phraseTagService->phraseTagWhitelist();

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
    public function update(Request $request, $id,PhraseTagService $phraseTagService)
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
    

        $tags = $request->get('phrase_tag');

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