@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'ご利用ガイド')

@section('content')

<!--==============レイアウトを制御する独自のCSSを読み込み===============-->
<!-- <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
<link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/9-2-1/css/9-2-1.css"> -->
<style>
  @charset "UTF-8";

/*アコーディオンタイトル*/
.title {
    position: relative;/*+マークの位置基準とするためrelative指定*/
    cursor: pointer;
    font-size:1rem;
    font-weight: normal;
    padding: 3% 3% 3% 50px;
    transition: all .5s ease;
}

/*アイコンの＋と×*/
.title::before,
.title::after{
    position: absolute;
    content:'';
    width: 15px;
    height: 2px;
    background-color: #333;
    
}
.title::before{
    top:48%;
    left: 15px;
    transform: rotate(0deg);
    
}
.title::after{    
    top:48%;
    left: 15px;
    transform: rotate(90deg);

}
/*　closeというクラスがついたら形状変化　*/
.title.close::before{
  transform: rotate(45deg);
}

.title.close::after{
  transform: rotate(-45deg);
}

/*アコーディオンで現れるエリア*/
.box {
    display: none;/*はじめは非表示*/
    background: #f3f3f3;
  margin:0 3% 3% 3%;
    padding: 3%;
}
</style>
    
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-6">
            <h2>非会員が利用可能なサービス</h2>
            <ul>
                <li>表現探し</li>
                <li>イベントに投稿されたエントリーへの投票</li>
            </ul>
        </div>
        <div class="col-sm-6">
            <h2><strong>ユーザーになれば利用可能なサービス</strong></h2>
            <ul>
                <li>お気に入りブックマーク登録</li>
                <li>表現の作成、登録</li>
                <li>イベントの作成、イベントへのエントリー投稿</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2><strong>ご利用ガイド</strong></h2>
            <h2><strong>ユーザーの方がご利用可能なサービス</strong></h2>

            <section class="card mb-5 pop-card">
                <div class="title">表現の作成、登録の仕方</div>
                <!-- <h3 class="title">表現の作成、登録の仕方</h3> -->
                <div class="box">
                    <p>上のナビバー又は下のメニューの｢｣を開き、作成登録したい表現を表現欄に記入して、それに当てはまるカテゴリを選択して、作成ボタンを押していただいたら表現の作成、登録ができます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p>
                </div>
            </section>

            <section class="card mb-5 pop-card">
                <div class="title">イベントの作成</div>
                <!-- <h3 class="title">イベントの作成</h3> -->
                <div class="box">
                    <p>上のナビバー又は下のメニューの｢｣を開き、作成したいイベントについてをイベント内容欄に記入して、(それに当てはまるカテゴリを選択して、)イベント終了日時の指定をして、作成ボタンを押していただいたらイベントの作成ができます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p>
                </div>
            </section>

            <section class="card mb-5 pop-card">
                <div class="title">エントリーの作成</div>
                <!-- <h3 class="title">エントリーの作成</h3> -->
                <div class="box">
                    <p>上のナビバー又は下のメニューの｢｣を開き、作成したいイベントについてをイベント内容欄に記入して、(それに当てはまるカテゴリを選択して、)イベント終了日時の指定をして、作成ボタンを押していただいたらイベントの作成ができます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p>
                </div>
            </section>

            <h2><strong>ご利用ガイド</strong></h2>
            <h2><strong>非ユーザーの方もご利用可能なサービス</strong></h2>

            <section class="card mb-5 pop-card">
                <div class="title">投票の仕方</div>
                <!-- <h3 class="title">投票の仕方</h3> -->
                <div class="box">
                    <p>各イベントに投稿されているエントリーの下に｢｣ボタンがあるので</p>
                    <p>※こちらは非ユーザーの方もご利用いただけるサービスとなっております。</p>
                </div>
            </section>

        </div>
    </div>
</div>

<script>

//アコーディオンをクリックした時の動作
$('.title').on('click', function() {//タイトル要素をクリックしたら
  var findElm = $(this).next(".box");//直後のアコーディオンを行うエリアを取得し
  $(findElm).slideToggle();//アコーディオンの上下動作
    
  if($(this).hasClass('close')){//タイトル要素にクラス名closeがあれば
    $(this).removeClass('close');//クラス名を除去し
  }else{//それ以外は
    $(this).addClass('close');//クラス名closeを付与
  }
});

</script>

@endsection('content')

