<?php
//トップ
Breadcrumbs::for('top', function ($trail) {
  $trail->push('トップ', url('/'));
});

//お問い合わせ
Breadcrumbs::for('about.contact.create', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('お問い合わせ', route('about.contact.create'));
});

//ご利用ガイド
Breadcrumbs::for('about.guide', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('ご利用ガイド', route('about.guide'));
});

//利用規約
Breadcrumbs::for('about.rule', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('利用規約', route('about.rule'));
});

//表現を探す
Breadcrumbs::for('search.index', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('表現を探す', route('search.index'));
});

//表現の検索結果
Breadcrumbs::for('search.result', function ($trail) {
  $trail->parent('search.index');
  $trail->push('表現の検索結果', route('search.result'));
});

////////////////////guest/////////////////////
//表現一覧
Breadcrumbs::for('phrase.index', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('表現一覧', route('phrase.index'));
});

//表現詳細
Breadcrumbs::for('phrase.show', function ($trail,$phrase) {
   if(request()->input("from") == "my"){
      $trail->parent('user.phrase.index');
      }elseif(request()->input("from") == "bookmark"){
      $trail->parent('user.user_bookmark_list');
      }else{
      $trail->parent('phrase.index');
  }
  $trail->push("表現: {$phrase->phrase}", url('/phrase/' . $phrase->id));
});

//イベント
Breadcrumbs::for('event.index', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('イベントメニュー', route('event.index'));
});

//イベント詳細
Breadcrumbs::for('event.detail', function ($trail,$event) {
   $trail->parent('event.index');
   $trail->push("イベント: {$event->event_text}",url('/event/detail/' . $event->id));
});

//エントリー詳細
Breadcrumbs::for('event.post.detail', function ($trail,$post) {
  $trail->parent('event.index');
  $trail->push("イベント: {$post->event->event_text}",url('/event/detail/' . $post->event->id));
  $trail->push("エントリー: {$post->post_text}",url('/event/post/detail' . $post->id));
});
 
////////////////////guest/////////////////////

/////////////////////user/////////////////////
//MyMenu
Breadcrumbs::for('home', function ($trail) {
  $trail->push('MyMenu', route('home'));
});

//プロフィール情報(設定)
Breadcrumbs::for('user_info.index', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('プロフィール情報(設定)', route('user_info.index'));
});

//ログインネームの変更
Breadcrumbs::for('user_name.edit', function ($trail) {
  $trail->parent('user_info.index');
  $trail->push('ログインネームの変更', route('user_name.edit'));
});

//メールアドレスの変更
Breadcrumbs::for('user_email.edit', function ($trail) {
  $trail->parent('user_info.index');
  $trail->push('メールアドレスの変更', route('user_email.edit'));
});

//パスワードの変更
Breadcrumbs::for('user_password.edit', function ($trail) {
  $trail->parent('user_info.index');
  $trail->push('パスワードの変更', route('user_password.edit'));
});

//退会する
Breadcrumbs::for('user_info.delete_confirm', function ($trail) {
  $trail->parent('user_info.index');
  $trail->push('退会する', route('user_info.delete_confirm'));
});

//表現作成
Breadcrumbs::for('user.phrase.create', function ($trail) {
  $trail->parent('phrase.index');
  $trail->push('表現作成', route('user.phrase.create'));
});

//表現編集
Breadcrumbs::for('user.phrase.edit', function ($trail,$phrase) {
  $trail->parent('phrase.show',$phrase);
  $trail->push("表現: {$phrase->phrase}",url('/user/phrase/' . $phrase->id));
});

//自分の表現一覧
Breadcrumbs::for('user.phrase.index', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('自分の表現一覧', route('user.phrase.index'));
});

//ブックマーク
Breadcrumbs::for('user.user_bookmark_list', function ($trail) {
  $trail->parent('top');
  $trail->push('MyMenu', route('home'));
  $trail->push('ブックマーク', route('user.user_bookmark_list'));
});

//イベント作成
Breadcrumbs::for('user.event.create', function ($trail) {
  $trail->parent('event.index');
  $trail->push('新規イベント作成', route('user.event.create'));
});

//エントリー作成
Breadcrumbs::for('user.event.post', function ($trail,$event) {
  $trail->parent('event.index');
  $trail->push("イベント: {$event->event_text}",url('/event/detail/' . $event->id));
  $trail->push("イベント: {$event->event_text}にエントリー",url('/user/event/post/' . $event->id));
});
/////////////////////user/////////////////////
 
/////////////////////admin/////////////////////
//トップ
Breadcrumbs::for('adminTop', function ($trail) {
  $trail->push('管理側トップ', route('admin.top'));
});

//表現作成
Breadcrumbs::for('admin.phrase.create', function ($trail) {
  $trail->parent('admin.phrase.index');
  $trail->push('管理者表現作成', route('admin.phrase.create'));
});

//表現一覧
Breadcrumbs::for('admin.phrase.index', function ($trail) {
  $trail->parent('adminTop');
  $trail->push('管理者表現一覧', route('admin.phrase.index'));
});

//表現詳細
Breadcrumbs::for('admin.phrase.show', function ($trail,$phrase) {
  $trail->parent('admin.phrase.index');
  $trail->push("表現: {$phrase->phrase}", url('/admin/phrase/show/' . $phrase->id));
});

//表現編集
Breadcrumbs::for('admin.phrase.edit', function ($trail,$phrase) {
  $trail->parent('admin.phrase.index');
  $trail->push("表現: {$phrase->phrase}",url('/admin/phrase/' . $phrase->id));
});

//カテゴリ作成
Breadcrumbs::for('admin.phrase_category.create', function ($trail) {
  $trail->parent('admin.phrase_category.index');
  $trail->push('管理者カテゴリ作成', route('admin.phrase_category.create'));
});

//カテゴリ一覧
Breadcrumbs::for('admin.phrase_category.index', function ($trail) {
  $trail->parent('adminTop');
  $trail->push('管理者カテゴリ一覧', route('admin.phrase_category.index'));
});

//カテゴリ編集
Breadcrumbs::for('admin.phrase_category.edit', function ($trail,$phraseCategory) {
  $trail->parent('admin.phrase_category.index');
  $trail->push("カテゴリ: {$phraseCategory->phrase_category}",url('/admin/phrase_category/' . $phraseCategory->id));
});

//イベント作成
Breadcrumbs::for('admin.event.create', function ($trail) {
  $trail->parent('admin.event.index');
  $trail->push('管理者イベント作成', route('admin.event.create'));
});

//イベント一覧
Breadcrumbs::for('admin.event.index', function ($trail) {
  $trail->parent('adminTop');
  $trail->push('管理者イベント一覧', route('admin.event.index'));
});

//イベント詳細
Breadcrumbs::for('admin.event.detail', function ($trail,$event) {
  $trail->parent('admin.event.index');
  $trail->push("イベント: {$event->event_text}",url('/admin/event/detail/' . $event->id));
});

//エントリー作成
Breadcrumbs::for('admin.event.post', function ($trail,$event) {
  $trail->parent('admin.event.index');
  $trail->push("イベント: {$event->event_text}",url('/admin/event/detail/' . $event->id));
  $trail->push("イベント: {$event->event_text}にエントリー",url('/admin/event/post/' . $event->id));
});

//エントリー詳細
Breadcrumbs::for('admin.event.post.detail', function ($trail,$post) {
  $trail->parent('admin.event.index');
  $trail->push("イベント: {$post->event->event_text}",url('/admin/event/detail/' . $post->event->id));
  $trail->push("エントリー: {$post->post_text}",url('/admin/event/post/detail/' . $post->id));
});

/////////////////////admin/////////////////////