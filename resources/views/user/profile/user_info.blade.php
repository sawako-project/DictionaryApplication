@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'プロフィール情報(設定)')

@section('content')

<div class="container">
   <div class="row">
      <div class="col-auto my-info">
         <div class="card mb-3 base-card" id="selectCard" >
            <div class="card-body">
               <ul>
                  <li><i class="bi bi-person-fill"></i>ログインネーム: {{$user->name}}</li>
                  <p><a href="{{ url('/user/reset/name') }}">ログインネームの変更</a></p>
                  <li><i class="bi bi-envelope-fill"></i>メールアドレス: {{$user->email}}</li>
                  <p><a href="{{ url('/user/reset/email') }}">メールアドレスの変更</a></p>
                  <li><i class="bi bi-key-fill"></i>パスワード: **********</li>
                  <p><a href="{{ url('/user/reset/password') }}">パスワードの変更</a></p> 
               </ul>
               <a href="{{ url('/user/info/delete') }}"><button class="btn btn-danger text-white">退会する</button></a>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection('content')