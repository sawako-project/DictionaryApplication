<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
//use Illuminate\Support\Facades\Auth;
use DB;
use App\User; //❗️
use Carbon\Carbon;

use App\Phrase;
use App\PhraseCategory; //
use App\BaseCategory;
use App\BaseCategoryMaster;
use App\PhraseTag; //
use App\Word;

use App\PhraseLike;

use App\Event;
use App\EventTypeMaster;
use App\EventPost;
use App\EventVote;

use Illuminate\Support\Facades\Hash;//パスワードのハッシュ化用

// use Illuminate\Foundation\Auth\RegistersUsers;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use App\Providers\RouteServiceProvider;

class UserInfoController extends Controller
{
    // use RegistersUsers;

    // use AuthenticatesUsers;

    // protected $redirectTo = RouteServiceProvider::HOME;

    //
    public function index(Request $request)
    {
        return view('user.profile.user_info')->with([
            'user' => Auth::user()
        ]);
    }

    //
    public function nameEdit(Request $request)
    {
        return view('user.profile.name_edit')->with([
            'user' => Auth::user()
        ]);
    }

    public function nameUpdate(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'name' =>  ['required', 'string', 'max:255']

        ]);

        $user->name = $request->get('name');
        $user->save();


        //return back();
        return redirect()->route("user_name.edit")->with('success', 'saved!'); // | user_info.name
    }


    //
    public function emailEdit(Request $request)
    {

        return view('user.profile.email_edit')->with([
            'user' => Auth::user()
        ]);
    }

    public function emailUpdate(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        $user->email = $request->get('email');
        $user->save();

        //return back();
        return redirect()->route("user_email.edit")->with('success', 'saved!');
    }


    //
    public function passwordEdit(Request $request)
    {
        return view('user.profile.password_edit')->with([
            'user' => Auth::user()
        ]);
    }

    public function passwordUpdate(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $newPassword = $request->get('password');
        $user->password = Hash::make($newPassword);
        $user->save();


        //return back();
        return redirect()->route("user_password.edit")->with('success', 'saved!');
    }

    //退会画面
    public function delete_confirm() //Request $request,$id
    {
        return view('user.profile.delete_confirm')->with([
            'user' => Auth::user()
        ]);
    }

    //退会処理
    public function delete($id) //Request $request,$id
    {
        $user = User::find($id);
        $user->delete();
        //退会後
        return redirect('/');
    }

    
    

}
