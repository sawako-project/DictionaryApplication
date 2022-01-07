<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;

use App\Mail\ContactSendmail;//ユーザー宛
use App\Mail\AdminSendmail;//管理者宛

use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function create()
    {
        //call_name
        //name
        //email
        //title
        //contact_text

        return view('about.contact.create');
    }
    
    public function confirm(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'call_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'nullable',
            'contact_text'  => 'required',
        ]);
        
        //フォームから受け取ったすべてのinputの値を取得
        $inputs = $request->all();

        //入力内容確認ページのviewに変数を渡して表示
        return view('about.contact.confirm', [
            'inputs' => $inputs,
        ]);
    }

    public function send(Request $request)
    {
        //バリデーションを実行（結果に問題があれば処理を中断してエラーを返す）
        $request->validate([
            'call_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'nullable',
            'contact_text'  => 'required',
        ]);

        //フォームから受け取ったactionの値を取得
        $action = $request->input('action');

        //フォームから受け取ったactionを除いたinputの値を取得
        $inputs = $request->except('action');

        //actionの値で分岐
        if($action !== 'submit'){

            return redirect()
            ->route('about.contact.create')
            ->withInput($inputs);

        }else{
                
            Mail::send(new AdminSendmail($inputs));
            //入力されたメールアドレスにメールを送信
            Mail::send(new ContactSendmail($inputs));
            
            //再送信を防ぐためにトークンを再発行
            $request->session()->regenerateToken();

            //送信完了ページのviewを表示
            return view('about.contact.send');
            //return view('admin.contact.done');管理者確認用
        }
        
    }

}