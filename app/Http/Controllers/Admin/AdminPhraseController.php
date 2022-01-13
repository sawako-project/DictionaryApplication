<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Phrase;
use App\PhraseCategory;
use App\BaseCategory;
use App\BaseCategoryMaster;
use App\PhraseTag;
use App\Word;

use App\Services\PhraseTag\PhraseTagService;

use Illuminate\Pagination\Paginator;

class AdminPhraseController extends Controller
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

			})->orderBy("id", "desc")->paginate(10);

            return view('admin.phrases.index', compact('phrases'));
        }

        $phraseTag_id = $req->input("t");

        if($phraseTag_id){

            $phrases = Phrase::whereHas("phraseTags", function($query) use($phraseTag_id) {
				
				//ここはPharseTagの絞り込み条件を書く
				$query->where("phrase_tag_id", $phraseTag_id);

			})->orderBy("id", "desc")->paginate(10);

            return view('admin.phrases.index', compact('phrases'));
        }
  
        $phrases = Phrase::orderBy('id','desc')->paginate(10);
        return view('admin.phrases.index', compact('phrases'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PhraseTagService $phraseTagService)
    {
        $phraseCategories = PhraseCategory::all();

        list($phraseTags, $whitelist) = $phraseTagService->phraseTagWhitelist();

        return view('admin.phrases.create', compact('phraseCategories','phraseTags','whitelist'));
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
        $phrase->save();
       
        //phrase_category
        $phrase_category_id = $request->get('phrase_category');
        $phrase->phraseCategories()->attach($phrase_category_id);

        //phrase_tag
        $tags = $request->get('phrase_tag');

        $tagList = $phraseTagService->phraseTagJsonDecode($tags);

        $phrase->phraseTags()->attach($tagList);

        return redirect()->route("admin.phrase.index")->with('success', 'saved!');
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phrase = Phrase::find($id);
        return view('admin.phrases.show', compact('phrase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,PhraseTagService $phraseTagService)
    {

        $phrase = Phrase::find($id);
        $phraseCategories = PhraseCategory::all();
        $selected_categories = $phrase->phraseCategories->pluck("id")->toArray();
        $baseCategoryLabels = BaseCategoryMaster::labels();

        list($phraseTags, $whitelist) = $phraseTagService->phraseTagWhitelist();

        $tagList = $phrase->phraseTags()->pluck("phrase_tag")->toArray();
     
        return view('admin.phrases.edit', compact('phrase', 'phraseCategories', 'selected_categories', 'baseCategoryLabels', 'tagList', 'whitelist','phraseTags'));
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

        $request->validate([
            'phrase'=>'required',
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
        
        return redirect()->route("admin.phrase.index")->with('success', 'saved!');
    }

    /**
     * Remove the specifi//ed resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Phrase::find($id)->delete();
        return redirect()->route("admin.phrase.index")->with('success', 'deleted!');
    }

}