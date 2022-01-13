<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
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

class UserEventController extends Controller
{
    //
    // public function index()//
    // {
        
    // }

    public function create(){

            return view('user.event.create',[
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
        $event->user_id = Auth::id();

        $event->schedule_end = $request->input('schedule_end');

            //忘れた時は
            if(!$event->schedule_end){
            $event->schedule_end = new Carbon("+30 days");
            }

        $event_type = $request->get('event_type');//radio
        $event->event_type = $event_type;

        $event->save();

        return redirect()->route("event.index")->with('success', 'saved!');

    }

    public function post($id)
    {
        $event = Event::find($id);
        if(!$event){
            return redirect()->route("event.index");
        }
        return view('user.event.post', compact('event'));

    }
 
    public function postDone(Request $request,$eventId)
    {
 
        $event = Event::find($eventId);
        if(!$event){
            return redirect()->route("event.index");
        }
        $request->validate([
            'post_text'=>'required'
        ]);

        $event_post = new EventPost();
        $event_post->post_text = $request->get('post_text');

        $event_post->event_id = $event->id;
        $event_post->user_id = Auth::id();
        $event_post->save();
        

        //Phraseの自動作成
        // if($request->input("auto_phrase")){
        // $event_post->createPhrase($event);
        // }

        return redirect()->route("event.detail",['event_id' => $eventId])->with('success', 'saved!');
    }


}