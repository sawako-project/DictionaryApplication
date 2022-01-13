<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<title>{{ config('app.name', 'Dectionary') }}</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all">

<!-- Bootstrap icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<script src="{{ asset('js/app.js') }}" defer></script>

<!--==============レイアウトを制御する独自のCSSを読み込み===============-->
<!-- <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-2/css/5-1-2.css"> -->

<style>
  
@charset "utf-8";
@import url('https://fonts.googleapis.com/css2?family=Ephesis&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap');
@import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap');
@import url('https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap');

/*========= ナビゲーションドロップダウンのためのCSS ===============*/

/*==ナビゲーション全体の設定*/
nav ul {
    list-style: none;
    text-align: center;
}

/*下の階層のulや矢印の基点にするためliにrelativeを指定*/
nav ul li {
    position: relative;
    /* font-family: 'Kiwi Maru', serif; */
}

/*ナビゲーションのリンク設定*/
nav ul li a {
    display: block;
    text-decoration: none;
    color: #fff;
    padding:15px;
    transition:all .3s;
}

nav ul li a:hover {
    color: #cda45e;
    background:#f3f3f3;/**#fff*/
}

/*==矢印の設定*/

/*2階層目を持つliの矢印の設定*/
nav ul li.has-child::before {
    content:'';
    position: absolute;
    right:30px;
    top:20px;
    width:6px;
    height:6px;
    border-top: 2px solid #999;
    border-right:2px solid #999;
    transform: rotate(45deg);
}

/*3階層目を持つliの矢印の設定*/
nav ul ul li.has-child::before {
    content:'';
    position: absolute;
    left:15px;
    top:21px;
    width:6px;
    height:6px;
    border-top: 2px solid #fff;
    border-right:2px solid #fff;
    transform: rotate(45deg);
}

/*== 2・3階層目の共通設定 */

/*下の階層を持っているulの指定*/
nav li.has-child ul {
    /*絶対配置で位置を指定*/
    position: absolute;
    left:100%;
    top:10px;
    z-index: 4;
    /*形状を指定*/
    background:#fff;
    width:180px;
    /*はじめは非表示*/
    visibility: hidden;
    opacity: 0;
    /*アニメーション設定*/
    transition: all .3s;
}

/*hoverしたら表示*/
nav li.has-child:hover > ul,
nav li.has-child ul li:hover > ul,
nav li.has-child:active > ul,
nav li.has-child ul li:active > ul {
    visibility: visible;
    opacity: 1;
}

/*ナビゲーションaタグの形状*//** dropdown下のリンク*/
nav li.has-child ul li a {
    color: #000;
    border-bottom:solid 1px #000;
}

nav li.has-child ul li:last-child a {
    border-bottom:none;
}

nav li.has-child ul li a:hover,
nav li.has-child ul li a:active {
    background:#f3f3f3;
    color: #cda45e; 
}

/*==768px以下の形状*/

@media screen and (max-width:768px) {

    nav {
        background:#333;
        color: #fff;
    }
    
    nav li.has-child ul,
    nav li.has-child ul ul {
      position: relative;
      left:0;
      top:0;
      width:100%;
      visibility:visible;/*JSで制御するため一旦表示*/
      opacity:1;/*JSで制御するため一旦表示*/
      display: none;/*JSのslidetoggleで表示させるため非表示に*/
      transition:none;/*JSで制御するためCSSのアニメーションを切る*/
    }

    nav ul li a {
        border-bottom:1px solid #ccc;
        color:#fff;
    }

    /*矢印の向き*/
    nav ul li.has-child::before,
    nav ul ul li.has-child::before {
        transform: rotate(135deg);
        left:20px;
    }
    
    nav ul li.has-child.active::before {
        transform: rotate(-45deg);
    }
}

/*========= レイアウトのためのCSS ===============*/

#container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    background-color: rgb(250, 242, 232);/*rgb(234,209,220)*/
}

#header {
    width:17%;
    background:#333;
    color: #fff;
    /* font-family: 'Kiwi Maru', serif; */
}

#main-area {
    /*width:78%;*/
    width:80%;
    /* font-family: 'Kiwi Maru', serif; */
}

section {
    padding:30px;
}

@media screen and (max-width:768px) {

    #header,
    #main-area {
        width:100%;
    } 
}

/*#fff->#f3f3f3  */
/* h1{
  font-size:2rem; 
  text-align: center;
  text-transform: uppercase;
  padding: 20px;
  font-family: 'Ephesis', cursive;
} */

#header h2 {
    font-size:2rem;/** 1.2rem*/
    text-align: center;
    /* margin: 0 0 30px 0; */
    font-family: 'Ephesis', cursive;
    padding: 20px;
    color: #fff;
}

#header h2 a {
    text-decoration: none;
    color: #fff;
}

#header h5 {
    color: #fff;
}

#header h5 a {
    color: #fff;
}

#header h5,nav {
    font-family: 'Kiwi Maru', serif;
}

p {
    margin-top:20px;  
}

/* small{
  background:#333;
  color:#fff;
  display: block;
  text-align: center;
  padding:20px;
} */

/** 
.card :hover {
  box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
  -webkit-transition: all 1s -0.2s ease-in-out;
-moz-transition: all 1s -0.2s ease-in-out;
-o-transition: all 1s -0.2s ease-in-out;
transition: all 1s -0.2s ease-in-out;
} */

</style>
</head>
<body>
    <div id="container">
        <header id="header">
            <h2><a href="{{ url('/') }}">Dictionary.</a></h2><!-- <h1>Dictionary.</h1> -->
            <h5 class="card-title text-center"><a href="{{ url('/home') }}"><i class="bi bi-person-fill fa-2x"></i>{{$user->name}}</a></h5>
            <nav>
                <ul>
                    <li><a href="{{ url('/search') }}">表現を探す</a></li>
                    <li><a href="{{ url('/phrase') }}">表現を見る</a></li>
                    <li><a href="{{ url('/event') }}">イベント</a></li>
                    <li><a href="{{ url('/user/phrase/create') }}">表現作成</a></li>
                    <li><a href="{{ url('/user/phrase') }}">自分の表現</a></li>
                    <li><a href="{{ url('/user/bookmark_list') }}">ブックマーク</a></li>
                    <li><a href="{{ url('/user/event/create') }}">イベント作成</a></li>
                    <li><a href="{{ url('/user/info') }}">プロフィール情報(設定)</a></li><!-- /user/plot '/user/info/{user_name}' -->
                    <li><a href="{{ url('/logout') }}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                    <li class="has-child"><a href="{{ url('/home') }}">About<br/>(Dictionaryについて)</a>
                        <ul>
                            <li><a href="{{ url('/guide') }}">ご利用ガイド</a></li>
                            <li><a href="{{ route('about.contact.create') }}">お問い合わせ</a></li>
                            <li><a href="{{ url('/rule') }}">利用規約</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <main id="main-area">
            <section id="area-1">
                <div class="row justify-content-center">
                    <div class="heading">
                        <h2><strong><span class="under">{{ $user->name }}'s Menu.</span></strong></h2>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3 pop-card" >
                            <div class="card-body">
                                <!-- <a href="{{-- url('/user/bookmark_list') --}}"> -->
                                    <h5 class="card-title">ブックマーク</h5>
                                    <p class="card-text">{{ $myAllPhraseLikesCount }}個</p>
                                    <!-- <p class="card-text"> あなたのブックマーク表現全般</p> -->
                                    <div class="item_box">
                                    @if($myAllPhraseLikes)
                                        @foreach ($myAllPhraseLikes as $myAllPhraseLike)
                                        <p class="card-text">{{ $myAllPhraseLike->phrase->phrase }}</p>
                                        <!-- <hr/> -->
                                        @endforeach
                                    @endif
                                    </div>
                                    
                                <!-- </a> -->
                            </div>
                            <hr/>
                            <p class="text-right"><a href="{{ url('/phrase') }}">お気に入りを探しにいく(見つける)<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3 pop-card" >
                            <div class="card-body">
                                <!-- <a href="{{-- url('/user/phrase') --}}"> -->
                                    <h5 class="card-title">自分の表現</h5>
                                    <p class="card-text">{{ $myAllPhrasesCount }}個</p>
                                    <!-- <p class="card-text"> あなたの作った表現全般</p> -->
                                    <div class="item_box">
                                    @if($myAllPhrases)
                                        @foreach ($myAllPhrases as $myAllPhrase)
                                        <p class="card-text">{{ $myAllPhrase->phrase }} </p>
                                        <hr/>
                                        @endforeach
                                    @endif
                                    </div>                   
                                <!-- </a> -->
                            </div>
                            <hr/>
                            <p class="text-right"><a href="{{ url('/user/phrase/create') }}">表現を作る<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card mb-3 pop-card" >
                            <div class="card-body ">
                                <!-- <a href="{{-- url('/event') --}}"> -->
                                    <h5 class="card-title">イベント</h5>
                                    <p class="card-text">{{ $myAllEventsCount }}個</p>
                                    <!-- <p class="card-text"><i class="bi bi-person-fill"></i></p> -->
                                    <!-- <p class="card-text"> あなたの作ったイベント全般</p> -->
                                    <div class="item_box">
                                    @if($myAllEvents)      
                                        @foreach ($myAllEvents as $myAllEvent)
                                        <p class="card-text">{{ $myAllEvent->event_text }}</p>
                                        <hr/>
                                        @endforeach
                                    @endif
                                    </div>              
                                <!-- </a> -->
                            </div>
                            <hr/>
                            <p class="text-right"><a href="{{ url('/user/event/create') }}">イベントを作る<span><i class="bi bi-arrow-right-short"></i></span></a></p>    
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3 pop-card">
                            <a href="{{-- url('/phrase') --}}">
                                <div class="card-body">
                                    <h5 class="card-title">表現の掲示板</h5> --><!-- 表現一覧 -->
                                    <!-- <div class="item_box">
                                                @//if($everyAllPhrases)
                                              
                                              @//foreach ($everyAllPhrases as $everyAllPhrase)
                                                <p class="card-text">{{-- $everyAllPhrase->phrase --}}</p>
                                                <hr/>
                                                @//endforeach
                                                @//endif

                                                </div> -->
                                    <!-- <p class="card-text"></p> -->
                                    <!-- <p class="card-text">
                                        <small class="text-muted">：</small>
                                    </p> -->
                                    <!-- <p class="card-text">{{-- $everyAllPhrasesCount --}}個</p>
                                </div>
                            </a>
                        </div>
                    </div> -->
        
                  <!-- <div class="col-md-6">
                      <div class="card mb-3 pop-card" >
                          
                          <div class="card-body ">
                              <a href="{{-- url('/home') --}}">
                                  <h5 class="card-title"></h5>
                                  <p class="card-text"><i class="bi bi-person-fill"></i></p>
                                  <p class="card-text"> </p>
                                  <div class="item_box">
                                  
                                      <p class="card-text"></p>
                                      <hr/>
                                
                                  </div> -->
                              <!--  -->
                                      
                                              <!-- <p class="card-text">{{-- $myAllPhrase->count() --}}個</p> -->
                                              <!-- <p class="card-text">{{-- $myAllEvent->events_count --}}個</p> -->
                                            
                              <!-- <p class="card-text">{{-- $myAllEventsCount --}}個</p> -->
                                              <!-- <//?php
                                              //dd($myAllPhrases);
                                              // dd($myAllPhrase);
                                              //dd($myAllPhrase->phrase);
                                              ?> -->
                                              <!-- @//break
                                              @//endforeach
                                              @//endif -->
                                              
                              <!-- <p class="card-text">
                                  <small class="text-muted"></small>
                              </p> -->
                              <!-- </a>
                          </div>

                          <hr/>
                          <p class="text-right"><a href="{{-- url('/user/event/create') --}}">イベントを作る<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                    
                      </div>
                  </div>
              </div> -->

            </section><!--/area3-->
        </main><!--/main-->
    </div><!--/container-->

    <a href="#" class="back-to-top">
        <!-- <i class="fas fa-arrow-up"></i> -->
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Footer -->
    <footer class=" text-center text-white" style="background-color:#333333;">
    <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgb(33,37,41)"><!--#212529 rgba(0, 0, 0, 0.2) -->
            © 2021 Copyright:
            {{ config('app.name', 'Laravel') }}
        </div>
    <!-- Copyright -->
    </footer>
    <!-- Footer -->

<script>

//ドロップダウンの設定を関数でまとめる
function mediaQueriesWin(){

    var width = $(window).width();
    if(width <= 768) {//横幅が768px以下の場合

        $(".has-child>a").off('click'); //has-childクラスがついたaタグのonイベントを複数登録を避ける為offにして一旦初期状態へ
        $(".has-child>a").on('click', function() {//has-childクラスがついたaタグをクリックしたら
            var parentElem =  $(this).parent();// aタグから見た親要素の<li>を取得し
            $(parentElem).toggleClass('active');//矢印方向を変えるためのクラス名を付与して
            $(parentElem).children('ul').stop().slideToggle(500);//liの子要素のスライドを開閉させる※数字が大きくなるほどゆっくり開く
            return false;//リンクの無効化
        });
    }else{//横幅が768px以上の場合

        $(".has-child>a").off('click');//has-childクラスがついたaタグのonイベントをoff(無効)にし
        $(".has-child>a").removeClass('active');//activeクラスを削除
        $('.has-child').children('ul').css("display","");//スライドトグルで動作したdisplayも無効化にする
    }
}

// ページがリサイズされたら動かしたい場合の記述
$(window).resize(function() {
    mediaQueriesWin();/* ドロップダウンの関数を呼ぶ*/
});

// ページが読み込まれたらすぐに動かしたい場合の記述
$(window).on('load',function(){
    mediaQueriesWin();/* ドロップダウンの関数を呼ぶ*/
});

</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>

<script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-2/js/5-1-2.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>