<?php

namespace App\Http\Controllers\Admin;

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

class AdminEventController extends Controller
{
    //
    function index(Request $request, $mode = "all"){

        //現在時刻
        $nowTime = Carbon::now();
        $eventTypeLabels = EventTypeMaster::labels();

        // if($request->input('events')){
        //     $mode = "events";
        // }

        // if($request->input('events_hold')){
        //     $mode = "events_hold";
        // }
          
        // if($request->input('event_soonEnd')){
        //     $mode = "event_soonEnd";
        // }

        // $mode = "all";
        // if($request->input('events_end')){
        //     $mode = "events_end";
        // }

        
        if($mode == "all" || $mode == "events"){
            $events = Event::orderBy('updated_at','desc')->paginate(2, ["*"], 'events')->withPath("/admin/event/status/events");
        }

        if($mode == "all" || $mode == "events_hold"){
            $events_hold = Event::where("schedule_end",">",$nowTime)->orderBy("updated_at","desc")->paginate(2, ["*"], 'events_hold')->withPath("/admin/event/status/events_hold");
        }

        if($mode == "all" || $mode == "event_soonEnd"){
            //まもなく終了(今日～2日後に)
            $soon_min = Carbon::today();
            $soon_max = Carbon::parse("+2 days");
            
            $event_soonEnd = Event::where("schedule_end",">=",$soon_min)->where("schedule_end","<=",$soon_max)->orderBy('schedule_end','asc')->paginate(2, ["*"], 'event_soonEnd')->withPath("/admin/event/status/event_soonEnd");
        }

        if($mode == "all" || $mode == "events_end"){
            $events_end = Event::where("schedule_end","<",$nowTime)->orderBy("updated_at","desc")->paginate(2, ["*"], 'events_end')->withPath("/admin/event/status/events_end");
        }

        //view
        if($mode == "events"){
            return view("admin.event.index", compact('eventTypeLabels','events'));
        }

        if($mode == "events_hold"){
            return view("admin.event.index", compact('eventTypeLabels','events_hold'));
        }

        if($mode == "event_soonEnd"){
            return view("admin.event.index", compact('eventTypeLabels','event_soonEnd'));
        }

        if($mode == "events_end"){
            return view("admin.event.index", compact('eventTypeLabels','events_end'));
        }

        //mode == all
        return view("admin.event.index", compact('eventTypeLabels','events','events_hold','event_soonEnd','events_end'));
        
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

                return view('admin.event.closed_situation',[
                    'event' => $event,
                    'eventPosts' => $eventPosts    
                ]);

            }

        }else{
    
            //開催中
            return view('admin.event.detail', [
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
            return back()->withError("これはだめだ");
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

        return view('admin.event.post_detail', [
            'eventPost' => $eventPost,
            'vote' => $vote
        ]);

    }
  
    function vote(Request $request,$eventId,$eventPostId){
   
        $eventVote = EventVote::where('user_id',Auth::id())->where('event_post_id',$eventPostId)->where('event_id',$eventId)->first();

        $unuser_id = 999;
 
        //$eventVoteがあれば
        if($eventVote){

            $eventVote->vote = !$eventVote->vote;

        }else{
        
            //userじゃなかったら
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
                
            }

            $eventVote->save();
        
        }//$eventVoteがなければ
        
        $eventVote->save();
        return back();

    }//vote

    public function create(){

        return view('admin.event.create',[
            "event_type_list" => EventTypeMaster::all(),
            "phraseCategories" => PhraseCategory::all()
        ]);
    }

    public function store(Request $request){

        $request->validate([
        'event_text'=>'required',
        'event_type' => 'required',
        'schedule_end' => 'required'
        ]);

        $event = new Event();
        $event->event_text = $request->get('event_text');
        //$event->user_id = Auth::id();

        $event_type = $request->get('event_type');//radio
        $event->event_type = $event_type;

        $event->schedule_end = $request->input('schedule_end');
        
        //忘れた時は
        if(!$event->schedule_end){
        $event->schedule_end = new Carbon("+30 days");
        }

        $event->save();

        return redirect()->route("admin.event.index")->with('success', 'saved!');

    }

    public function post($id)
    {
        $event = Event::find($id);

        if(!$event){
            return redirect()->route("admin.event.index");
        }

        return view('admin.event.post', compact('event'));

    }

    public function postDone(Request $request,$eventId)
    {

        $event = Event::find($eventId);
        if(!$event){
            return redirect()->route("admin.event.index");
        }
        $request->validate([
            'post_text'=>'required'
        ]);

        $event_post = new EventPost();
        $event_post->post_text = $request->get('post_text');

        $event_post->event_id = $event->id;
        //$event_post->user_id = Auth::id();
        $event_post->save();
        

        //Phraseの自動作成
        // if($request->input("auto_phrase")){
        // $event_post->createPhrase($event);
        // }

        return redirect()->route("admin.event.detail",['event_id' => $eventId])->with('success', 'saved!');
    }


}