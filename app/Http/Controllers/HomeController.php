<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\User;
use Carbon\Carbon;

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


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)//$id
    {

        //userの

        $everyAllPhrases = Phrase::orderBy("id","desc")->take(3)->get();
        $everyAllPhrasesCount = Phrase::count();

        //phraseの
        //$myAllPhrases = Phrase::where('user_id','=',Auth::id())->get();
        // $myAllPhrases = Phrase::whereHas("user", function($query) {
        //     //ここはUserの絞り込み条件を書く
        //     $query->where("id", Auth::id());
        // })->get();
        //$myAllPhrases = DB::table('users')->withCount('phrases')->get();
        $myAllPhrases = Phrase::where('user_id',Auth::id())->orderBy("id","desc")->take(3)->get();
        $myAllPhrasesCount = Phrase::where('user_id',Auth::id())->count();

        //phraselikeの
        $myAllPhraseLikes = PhraseLike::where('user_id',Auth::id())->where("liked",1)->orderBy("id","desc")->take(3)->get();
        $myAllPhraseLikesCount = PhraseLike::where('user_id',Auth::id())->where("liked",1)->count();

        //eventの
        // $myAllEvents = User::where('id',Auth::id())->withCount('events')->orderBy('events_count','desc')->get();
        $myAllEvents = Event::where('user_id',Auth::id())->where('event_type','phraseAboutSituationEvent')->orderBy("id","desc")->take(3)->get();
        $myAllEventsCount = Event::where('user_id',Auth::id())->where('event_type','phraseAboutSituationEvent')->count();

        return view('home')->with([

            // "everyAllPhrases" => $everyAllPhrases,
            // "everyAllPhrasesCount" => $everyAllPhrasesCount,

            'myAllPhrases'=>$myAllPhrases,
            "myAllPhrasesCount"=>$myAllPhrasesCount,

            'myAllEvents'=>$myAllEvents,
            'myAllEventsCount'=>$myAllEventsCount,

            'myAllPhraseLikes'=>$myAllPhraseLikes,
            "myAllPhraseLikesCount"=>$myAllPhraseLikesCount,
            'user'=>Auth::user()
            ]);
    }
}
