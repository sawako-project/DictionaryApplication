<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PhraseLike;
use Auth;

class UserPhraseLikeController extends Controller
{
    //
    function doLike($id){
   
        $phraseLike = PhraseLike::where('user_id','=',Auth::id())
        ->where('phrase_id','=',$id)->first();

        if($phraseLike){

            $phraseLike->liked = !$phraseLike->liked;//$like->liked = 0;false;

        }else{

            $phraseLike = new PhraseLike();
            $phraseLike->liked = true;
            $phraseLike->user_id = Auth::id();//ログインしているidをDBのカラム｢user_id｣に入れる
            $phraseLike->phrase_id = $id;
        }

        $phraseLike->save();

        return back();
        //return redirect("/phrase");//->withStatus("Like DONE");

    }
}
