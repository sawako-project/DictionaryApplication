@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'ご利用ガイド')

@section('content')

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
.title::after {
    position: absolute;
    content:'';
    width: 15px;
    height: 2px;
    background-color: #333;
}

.title::before {
    top:48%;
    left: 15px;
    transform: rotate(0deg);
}

.title::after {    
    top:48%;
    left: 15px;
    transform: rotate(90deg);
}

/*　closeというクラスがついたら形状変化　*/
.title.close::before {
    transform: rotate(45deg);
}

.title.close::after {
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

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card text-center mb-5 base-card">
                <div class="card-body">
                    <h2>非ユーザーの方がご利用いただけるサービス</h2>
                    <hr/>          
                    <ul>
                        <li>検索バーでの表現探し</li>
                        <li>イベントに投稿されたエントリーへの投票</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card text-center mb-5 base-card">
                <div class="card-body">
                    <h2><strong>ユーザーになればご利用いただけるサービス</strong></h2>
                    <hr/>
                    <ul>
                        <li>気に入った表現のお気に入り、ブックマーク登録</li>
                        <li>表現の作成、カテゴリでの登録</li>
                        <li>イベントの作成、イベントへのエントリー投稿</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <div class="heading mb-5">
                <h2><strong><span class="under">ユーザーの方がご利用可能なサービス</span></strong></h2>
            </div>
            <section class="card mb-5 pop-card">
                <div class="title">表現のブックマークの仕方</div>
                <div class="box">
                    <p>上のナビバーの｢<i class="bi bi-person-fill"></i>(ユーザー名)｣をクリックして｢MyMenu｣を開き、メニューリストから｢表現を見る｣を開きます。そして気になった表現のカード下の<span class="btn btn-light"><i class="bi bi-bookmark"></i></span>をクリックすると<span class="btn btn-light"><i class="bi bi-bookmark-fill"></i></span>になります。 <span class="btn btn-light"><i class="bi bi-bookmark-fill"></i></span>になるとブックマーク完了です。</p>   
                    </p>また、再度
                        <span class="btn btn-light"><i class="bi bi-bookmark-fill"></i></span>をクリックすると
                        <span class="btn btn-light"><i class="bi bi-bookmark"></i></span>になります。     
                    </p>
                    <p>ブックマークした表現は、上のナビバーの｢<i class="bi bi-person-fill"></i>(ユーザー名)｣→MyMenuの｢ブックマーク｣から一覧で見れます。なお、<span class="btn btn-light"><i class="bi bi-bookmark-fill"></i></span>をクリックするとその表現は｢ブックマーク｣から削除されます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p> 
                </div>
                
            </section>

            <section class="card mb-5 pop-card">
                <div class="title">表現の作成の仕方</div>
                <div class="box">
                    <p>上のナビバーの｢<i class="bi bi-person-fill"></i>(ユーザー名)｣をクリックして｢MyMenu｣を開き、メニューリストから｢表現作成｣を開きます。そして作成したい表現の項目を欄内に記入し、それに当てはまるカテゴリを選択して、作成ボタンを押していただいたら表現の作成ができます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p>
                </div>
            </section>

            <section class="card mb-5 pop-card">
                <div class="title">イベントの作成の仕方</div>
                <div class="box">
                    <p>上のナビバーの｢<i class="bi bi-person-fill"></i>(ユーザー名)｣をクリックして｢MyMenu｣を開き、メニューリストから｢イベント作成｣を開きます。そして作成したいイベントの項目をイベント内容欄に記入し、それに当てはまるカテゴリを選択、イベント終了日時の指定をして、作成ボタンを押していただいたらイベントの作成ができます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p>
                </div>
            </section>

            <section class="card mb-5 pop-card">
                <div class="title">エントリーの作成の仕方</div>
                <div class="box">
                    <p>上のナビバーの｢<i class="bi bi-person-fill"></i>(ユーザー名)｣をクリックして｢MyMenu｣を開き、メニューリストから｢イベント｣を開きます。そして｢イベントメニュー｣の｢開催中のイベント｣、｢まもなく終了するイベント｣から参加したいイベントを選び、イベント内容下の｢イベントエントリー｣を押してエントリー欄に記入して、エントリーボタンを押していただいたらそのイベントへのエントリーの作成ができます。</p>
                    <p>※非ユーザーの方は利用いただけないサービスとなっております。</p>
                </div>
            </section>

            <div class="heading mb-5">
                <h2><strong><span class="under">非ユーザーの方もご利用可能なサービス</span></strong></h2>
            </div>
            <section class="card mb-5 pop-card">
                <div class="title">エントリーへの投票の仕方</div>
                <div class="box">
                    <p>非ユーザーの方は、上のナビバーの｢イベント｣を開き、｢イベントメニュー｣の｢開催中のイベント｣、｢まもなく終了するイベント｣から見たいイベントを選ぶと、イベント内容下に表示されているエントリーが見れます。そして各エントリー下に投票アイコン<span class="btn btn-light"><i class="bi bi-hand-thumbs-up"></i></span>があるのでその中で気になるエントリーを見つけて<span class="btn btn-light"><i class="bi bi-hand-thumbs-up"></i></span>を押していただくと<span class="btn btn-light"><i class="bi bi-hand-thumbs-up-fill"></i></span>になり、その気になるエントリーへの投票ができます。</p>
                    <p>ユーザーの方は、上のナビバーの｢<i class="bi bi-person-fill"></i>(ユーザー名)｣をクリックして｢MyMenu｣を開き、メニューリストから｢イベント｣を開きます。次に｢イベントメニュー｣の｢開催中のイベント｣、｢まもなく終了するイベント｣から見たいイベントを選ぶと、イベント内容下に表示されているエントリーが見れます。そして各エントリー下に投票アイコンがあるのでその中で気になるエントリーを見つけて投票アイコンを押していただいたらその気になるエントリーへの投票ができます。</p>
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