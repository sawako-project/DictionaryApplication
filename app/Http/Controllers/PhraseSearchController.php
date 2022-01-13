<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Phrase;
use App\PhraseCategory;
use App\PhraseTag;
use App\Word;

//表現探し、｢/search_phrases｣

class PhraseSearchController extends Controller
{

    public function index(Request $request){

        #キーワード受け取り
        // $keyword = $request->input('keyword');

        //   #クエリ生成
        //   $query = Phrase::query();
        
        //   #もしキーワードがあったら
        //   if(!empty($keyword))
        //   {
        //     $query->where('','like','%'.$keyword.'%')->orWhere('','like','%'.$keyword.'%');//?
        //   }
        
        //   #ページネーション
        //   $phrasesData = $query->orderBy('created_at','desc')->paginate(10);//$phrasesData

        // $category_result = PhraseCategory::where("phrase_category","like", '%'.$keyword.'%')->get();
        // $phrase_result = Phrase::where("phrase","like", '%'.$keyword.'%')->get();
    
        //表現
        $phrases = Phrase::orderBy('updated_at','desc')->take(10)->get();//'id','desc'

        //BaseCategory;::code,feelingでphrase_category_idのphrase_category
        $phraseCategories_feelings = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "feeling");
        })->orderBy("phrase_category_name", "asc")->get();//->orderBy("id", "desc")->get();//->pluck("phrase_category");
        
        //code,actionでphrase_category_idのphrase_category
        $phraseCategories_actions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "action");
        })->orderBy("phrase_category_name", "asc")->get();//->orderBy("id", "desc")->get();//->pluck("phrase_category");

        //BaseCategory;::code,expressionでphrase_category_idのphrase_category
        $phraseCategories_expressions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "expression");
        })->orderBy("phrase_category_name", "asc")->get();//->orderBy("id", "desc")->get();//->pluck("phrase_category");

        return view('search', compact('phrases','phraseCategories_feelings','phraseCategories_actions','phraseCategories_expressions'));
        //return view('search',compact('keyword','phrasesData', 'category_result', 'phrase_result'));
        //   return view('search_phrases')->with('phrasesData',$phrasesData)
        //   ->with('keyword',$keyword);
        //   //->with('message','ユーザーリスト');

    }

    public function search(Request $request){

        $keyword = $request->input('keyword');

        //検索結果
        $category_result = PhraseCategory::where("phrase_category","like", '%'.$keyword.'%')->get();
        $tag_result = PhraseTag::where("phrase_tag","like", '%'.$keyword.'%')->get();
        $phrase_result = Phrase::where("phrase","like", '%'.$keyword.'%')->get();
        $results = Phrase::where("phrase","like", '%'.$keyword.'%')->get();
        
        //最新の表現
        $phrases = Phrase::orderBy('updated_at','desc')->take(10)->get();//'id','desc'

        //カテゴリごとの表現
        //"code", "feeling"
        $phraseCategories_feelings = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "feeling");
        })->orderBy("phrase_category_name", "asc")->get();//->orderBy("id", "desc")->get();//->pluck("phrase_category");
        
        //"code", "action"
        $phraseCategories_actions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "action");
        })->orderBy("phrase_category_name", "asc")->get();//->orderBy("id", "desc")->get();//->pluck("phrase_category");

        //"code", "expression"
        $phraseCategories_expressions = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "expression");
        })->orderBy("phrase_category_name", "asc")->get();//->orderBy("id", "desc")->get();//->pluck("phrase_category");
        
        return view('search_phrases',compact('keyword','category_result','tag_result', 'phrase_result','results','phrases','phraseCategories_feelings','phraseCategories_actions','phraseCategories_expressions'));//$phrasesData

    }

}