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

use App\Event;
use App\EventTypeMaster;
use App\EventPost;
use App\EventVote;

use Carbon\Carbon;

class GuestEventController extends Controller
{
    //
    function index(Request $request, $mode = "all"){

        //現在時刻
        $nowTime = Carbon::now();
        $eventTypeLabels = EventTypeMaster::labels();

        // $mode = "all";
     
        // if($request->input('events')){
        //     $mode = "events";
        // }

        // if($request->input('events_hold')){
        //     $mode = "events_hold";
        // }

        // if($request->input('event_soonEnd')){
        //     $mode = "event_soonEnd";
        // }
        
        // if($request->input('events_end')){
        //     $mode = "events_end";
        // }

        
        if($mode == "all" || $mode == "events"){
            $events = Event::orderBy('updated_at','desc')->paginate(2, ["*"], 'events')->withPath("/event/status/events");
        }

        if($mode == "all" || $mode == "events_hold"){
            $events_hold = Event::where("schedule_end",">",$nowTime)->orderBy("updated_at","desc")->paginate(2, ["*"], 'events_hold')->withPath("/event/status/events_hold");
        }

        if($mode == "all" || $mode == "event_soonEnd"){
            //まもなく終了(今日～2日後まで)
            $soon_min = Carbon::today();
            $soon_max = Carbon::parse("+2 days");
            
            $event_soonEnd = Event::where("schedule_end",">=",$soon_min)->where("schedule_end","<=",$soon_max)->orderBy('schedule_end','asc')->paginate(2, ["*"], 'event_soonEnd')->withPath("/event/status/event_soonEnd");
        }

        if($mode == "all" || $mode == "events_end"){
            $events_end = Event::where("schedule_end","<",$nowTime)->orderBy("updated_at","desc")->paginate(2, ["*"], 'events_end')->withPath("/event/status/events_end");
        }


        if($mode == "events"){
            return view("guest.event.index", compact('eventTypeLabels','events'));
        }

        if($mode == "events_hold"){
            return view("guest.event.index", compact('eventTypeLabels','events_hold'));
        }

        if($mode == "event_soonEnd"){
            return view("guest.event.index", compact('eventTypeLabels','event_soonEnd'));
        }

        if($mode == "events_end"){
            return view("guest.event.index", compact('eventTypeLabels','events_end'));
        }

        //mode == all
        return view("guest.event.index", compact('events','eventTypeLabels','events_end','events_hold','event_soonEnd'));
        
    }
        
    function detail(Request $request,$eventId){

        $event = Event::findOrFail($eventId);
        $eventPost = EventPost::where('event_id',$eventId)->orderBy("id", "desc")->paginate(10);

        $postIdList = [];
        foreach($eventPost as $post){
            $postIdList[] = $post->id;
        }
        
        $allVotes = EventVote::where("user_id","=",Auth::id())
        ->whereIn("event_post_id",$postIdList)
        ->get();

        
        $votes = [];
        foreach($allVotes as $vote){
            $votes[$vote->event_post_id] = $vote->vote;
        }

        //締切
        if($event->isClosed()){//関数の呼び出し

            if($event->event_type == "phraseAboutSituationEvent"){

                $event = Event::findOrFail($eventId);
                $eventPosts = EventPost::where('event_id',$eventId)->withCount('votes')->orderBy('votes_count','desc')->paginate(10);

                return view('guest.event.closed_detail',[
                    'event' => $event,
                    'eventPosts' => $eventPosts    
                ]);

            }

        }else{
        
            //開催中
            return view('guest.event.detail', [
                'event' => $event,
                'eventPost' => $eventPost,
                "votes" => $votes
            ]);
        }

    }
  
    function postDetail(Request $request,$eventPostId){

        $eventPost = EventPost::findOrFail($eventPostId);
        
        if(!$eventPost){

            //return redirect()
            return back()->withError("エラーが発生しました");
        }

        if(!Auth::id()){

            //非会員
            $vote = EventVote::where("unuser_id","=",999)
            ->where("event_post_id","=",$eventPost->id)->first();
        }else{ 

            //会員
            $vote = EventVote::where("user_id","=",Auth::id())
            ->where("event_post_id","=",$eventPost->id)->first();
        }

        //締切
        if($eventPost->isClosed()){//関数の呼び出し

                return view('guest.event.closed_post_detail',[
                    'eventPost' => $eventPost,
                    'vote' => $vote
                ]);
                
        }else{
    
            return view('guest.event.post_detail', [
                'eventPost' => $eventPost,
                'vote' => $vote
            ]);
        }

    }
  
    function vote(Request $request,$eventId,$eventPostId){
   
        $eventVote = EventVote::where('user_id',Auth::id())->where('event_post_id',$eventPostId)->where('event_id',$eventId)->first();

        $unuser_id = 999;
 
        //$eventVoteがあれば
        if($eventVote){

            $eventVote->vote = !$eventVote->vote;

        }else{//$eventVoteがなければ
        
            if(!Auth::id()){

                $eventVote = new EventVote();
                
                $eventVote->vote = true;
                $eventVote->unuser_id = $unuser_id;

                    //$eventIdがあれば
                    if (isset($eventId)){
                        $eventVote->event_id = $eventId;
                    }

                $eventVote->event_post_id = $eventPostId;
                $eventVote->save();

            }else{//userであれば

                $eventVote = new EventVote();
                $eventVote->vote = true;
                $eventVote->user_id = Auth::id();

                    if (isset($eventId)){
                        $eventVote->event_id = $eventId;
                    }

                $eventVote->event_post_id = $eventPostId;
                $eventVote->save();
                
            }//!(Auth::id())

            $eventVote->save();
        
        }
        
        $eventVote->save();
        return back();

    }

}