<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Phrase;
use App\PhraseCategory;
use App\PhraseTag;
use App\Word;


class PhraseSearchController extends Controller
{

    public function index(Request $request){

    
        //表現
        $phrases = Phrase::orderBy('updated_at','desc')->take(10)->get();

        //code,feelingのphrase_category_name
        $phraseCategories_feelings = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "feeling");
        })->get();//->orderBy("phrase_category_name", "asc")->get();
        
        //code,actionのphrase_category_name
        $phraseCategories_actions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "action");
        })->get();//->orderBy("phrase_category_name", "asc")->get();

        //code,expressionのphrase_category_name
        $phraseCategories_expressions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "expression");
        })->get();//->orderBy("phrase_category_name", "asc")->get();

        return view('search', compact('phrases','phraseCategories_feelings','phraseCategories_actions','phraseCategories_expressions'));

    }

    public function search(Request $request){

        $keyword = $request->input('keyword');

        //検索結果
        $category_result = PhraseCategory::where("phrase_category","like", '%'.$keyword.'%')->get();
        $tag_result = PhraseTag::where("phrase_tag","like", '%'.$keyword.'%')->get();
        $phrase_result = Phrase::where("phrase","like", '%'.$keyword.'%')->get();
        $results = Phrase::where("phrase","like", '%'.$keyword.'%')->get();
        
        //最新の表現
        $phrases = Phrase::orderBy('updated_at','desc')->take(10)->get();

        //カテゴリごとの表現
        //"code", "feeling"
        $phraseCategories_feelings = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "feeling");
        })->get();//->orderBy("phrase_category_name", "asc")->get();
        
        //"code", "action"
        $phraseCategories_actions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "action");
        })->get();//->orderBy("phrase_category_name", "asc")->get();

        //"code", "expression"
        $phraseCategories_expressions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "expression");
        })->get();//->orderBy("phrase_category_name", "asc")->get();
        
        return view('search_phrases',compact('keyword','phrase_result','category_result','tag_result','results','phrases','phraseCategories_feelings','phraseCategories_actions','phraseCategories_expressions'));

    }

}