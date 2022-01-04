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

        // dd($mode);

        // $mode = "all";
        // if($request->input('events_end')){
        //     $mode = "events_end";
        // }
        
        // if($request->input('event_soonEnd')){
        //     $mode = "event_soonEnd";
        // }

        // if($request->input('events_hold')){
        //     $mode = "events_hold";
        // }

        // if($request->input('events')){
        //     $mode = "events";
        // }
        
        if($mode == "all" || $mode == "events"){
            $events = Event::orderBy('updated_at','desc')->paginate(2, ["*"], 'events')->withPath("/event/status/events");
        }

        if($mode == "all" || $mode == "events_hold"){
            $events_hold = Event::where("schedule_end",">",$nowTime)->orderBy("updated_at","desc")->paginate(2, ["*"], 'events_hold')->withPath("/event/status/events_hold");
            //$events_hold = Event::where("schedule_end",">",$nowTime)->orderBy("updated_at","desc")->get();
        }
        // dd($events_hold);
        if($mode == "all" || $mode == "event_soonEnd"){
            //まもなく終了(今日～2日後まで)
            $soon_min = Carbon::today();
            $soon_max = Carbon::parse("+2 days");
            
             $event_soonEnd = Event::where("schedule_end",">=",$soon_min)->where("schedule_end","<=",$soon_max)->orderBy('schedule_end','asc')->paginate(2, ["*"], 'event_soonEnd')->withPath("/event/status/event_soonEnd");
             }

        if($mode == "all" || $mode == "events_end"){
            $events_end = Event::where("schedule_end","<",$nowTime)->orderBy("updated_at","desc")->paginate(2, ["*"], 'events_end')->withPath("/event/status/events_end");
        }

        if($mode == "events_end"){
            return view("guest.event.index", compact('eventTypeLabels','events_end'));
        }

        if($mode == "event_soonEnd"){
            return view("guest.event.index", compact('eventTypeLabels','event_soonEnd'));
        }

        if($mode == "events_hold"){
            return view("guest.event.index", compact('eventTypeLabels','events_hold'));
        }

        if($mode == "events"){
            return view("guest.event.index", compact('eventTypeLabels','events'));
        }

        //mode ==all
        return view("guest.event.index", compact('events','eventTypeLabels','events_end','events_hold','event_soonEnd'));
        
    }
        
    function detail(Request $request,$eventId){//{event_id}
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
            if($event->isClosed()){//関数呼び出し

                if($event->event_type == "phraseAboutSituationEvent"){

        $event = Event::findOrFail($eventId);
        $eventPosts = EventPost::where('event_id',$eventId)->withCount('votes')->orderBy('votes_count','desc')->paginate(10);
        $event_posts = EventPost::where('event_id',$eventId)->withCount('votes')->orderBy('votes_count','desc');//->get()->all();
        //$array = $event_posts->get()->toArray();
        //$array = $event_posts->pluck('post_text')->toArray();
        //////////////////
        // $phrase->phrase = $event_posts->post_text;

        //Phraseの自動作成
//    if($request->input("auto_phrase")){
//     $event_post->createPhrase($event);
//     }
 
        // $phrase = new Phrase();
        // // $phrase->phrase = $request->get('post_text');
        // $phrase->phrase = $event_posts->post_text;

        // $phrase->user_id = $event_posts->user_id;
        
        // $phrase->save();


         //phraseがなければ作成
        //  $phrase = new Phrase([
        //     "user_id" => $event_posts->user_id,// $this->user_id
        //     "phrase" => $event_posts->post_text,// $this->post_text
        // ]);
        // $phrase->save();
        
        ////////////
        //dd($array);
//         //dd($event_posts);
//         //dd($eventPosts);
        // $arrays = array_slice($array , 0, 3);
        // dd($arrays);
// foreach($eventPost as $key => $value){
//     dd( "キー(\$key) : {$key}　値(\$value) : {$value}<br/>\n");
// }
// foreach($arrays as  $value){
//     //dd($value);
// }
        /////////////

        return view('guest.event.closed_situation',[//guest.event.closed_detail
            'event' => $event,
            'eventPosts' => $eventPosts    
        ]);

        }

        }else{
        
         
            //開催中
            return view('guest.event.detail', [
                'event' => $event,
                'eventPost' => $eventPost,
                "votes" => $votes,
                //"editable" => $eventPosts->user_id == Auth::id()
            ]);
        }

    }
  
    function postDetail(Request $request,$eventPostId){//event_post_id

        $eventPost = EventPost::findOrFail($eventPostId);
        //$eventPost = EventPost::where('id',$eventPostId)->orderBy("id", "desc")->paginate(10);
        if(!$eventPost){
            return back()->withError("これはだめだ");//return redirect()?
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

        // $postIdList = [];
        // foreach($eventPost as $post){
        //     $postIdList[] = $post->id;
        // }
        
        // $allVotes = EventVote::where("user_id","=",Auth::id())
        // ->whereIn("event_post_id",$postIdList)
        // ->get();

        
        // $votes = [];
        // foreach($allVotes as $vote){
        //     $votes[$vote->event_post_id] = $vote->vote;
        // }

        return view('guest.event.post_detail', [
            'eventPost' => $eventPost,
            'vote' => $vote
            //"editable" => $eventPosts->user_id == Auth::id()
        ]);

    }
  
    function vote(Request $request,$eventId,$eventPostId){
   
        $eventVote = EventVote::where('user_id',Auth::id())->where('event_post_id',$eventPostId)->where('event_id',$eventId)->first();

        $unuser_id = 999;
 
        //$eventVoteがあれば
        if($eventVote){

            $eventVote->vote = !$eventVote->vote;

        }else{
        
            //userじゃなかったら//if(!Auth::id())
            if(!Auth::id()){

                $eventVote = new EventVote();
                
                $eventVote->vote = true;
                $eventVote->unuser_id = $unuser_id;

                    //$eventIdがあれば
                    if (isset($eventId)){
                        $eventVote->event_id = $eventId;
                    }
                    //else{//$eventIdがなければ
                    //}   
                $eventVote->event_post_id = $eventPostId;
                $eventVote->save();

            }else{//(Auth::id())があれば

                $eventVote = new EventVote();
                $eventVote->vote = true;
                $eventVote->user_id = Auth::id();//ログインしているidをDBのカラム｢user_id｣に置き換え？
                    if (isset($eventId)){
                        $eventVote->event_id = $eventId;
                    }
                    //else{    
                    //}

                $eventVote->event_post_id = $eventPostId;
                $eventVote->save();
                
            }//else(Auth::id())

            $eventVote->save();
        
        }//$eventVoteがなければ
        
        $eventVote->save();
        return back();
        //return redirect()->route("event.vote", ['id' => $id,'theme_event_id' => $eventId])->with('success', 'saved!');

    }//vote

}//controller

/*
class PostDetail {

    public $event = null;
    public $evnetPost = null;
    public $votes = [];

    function __construct($eventPost, $votes){
        $this->event = $eventPost->event;
        $this->eventPost = $eventPost;
        $this->votes = $eventPost->votes;
    }

    function eventLabel(){
        return $this->event->eventLabel();
    }

    function isMine(){
        return $this->eventPost->user_id == Auth::id();
    }

    function isVotable(){
        return !$this->isMine();
    }

    function isVoted(){
        return $this->vote && $this->vote == 1;
    }

    function getEditLink(){

    }

    function getLink($type){
        if($type == "edit"){
            return route('user.phrase.edit',$this->phrase->id);
        }
    }

}
*/