<?php

namespace App\Http\Controllers;

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

use App\Event;
use App\EventTypeMaster;
use App\EventPost;
use App\EventVote;
use Carbon\Carbon;

class DictinaryController extends Controller
{

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //search


        //表現
        $phrases = Phrase::orderBy('updated_at', 'desc')->take(10)->get();//'id','desc'

        //"code", "feeling"
        $phraseCategories_feelings = PhraseCategory::whereHas("baseCategories", function($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "feeling");
        })->get();//->orderBy("phrase_category_name", "asc")->get();//->pluck("phrase_category");

        //"code", "action"
        $phraseCategories_actions = PhraseCategory::whereHas("baseCategories", function ($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "action");
        })->get();//->orderBy("phrase_category_name", "asc")->get();


        //"code", "expression"
        $phraseCategories_expressions = PhraseCategory::whereHas("baseCategories", function ($query) {
            //ここはBaseCategoryの絞り込み条件を書く
            $query->where("code", "expression");
        })->get();//->orderBy("phrase_category_name", "asc")->get();

        //イベント
        $nowTime = Carbon::now();//現在時刻
        $eventTypeLabels = EventTypeMaster::labels();

        //まもなく終了(今日～2日後まで)
        $soon_min = Carbon::today();
        $soon_max = Carbon::parse("+2 days");

        $event_soonEnd = Event::where("schedule_end", ">=", $soon_min)->where("schedule_end", "<=", $soon_max)->orderBy('schedule_end', 'asc')->take(3)->get();

        //開催中
        $events_hold = Event::where("schedule_end", ">", $nowTime)->orderBy("updated_at", "desc")->take(3)->get();

        return view('dictionary_top', compact('phrases', 'phraseCategories_feelings', 'phraseCategories_actions', 'phraseCategories_expressions', 'event_soonEnd', 'events_hold'));
    
    } 

}
