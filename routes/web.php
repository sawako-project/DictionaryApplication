<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/welcome', function () {
//     return view('welcome');
// });

//認証なしで見れる
//Route::group(['middleware' => ['simple.auth']], function(){

//トップ
Route::get('/','DictinaryController@index')->name("dictionary_top.index");

// Route::get('/','DictinaryController@index', function () {
//     session()->put(['simple_auth' => 'inko']);
// return session()->get("simple_password_auth");
// });


//お問い合わせ
Route::get('/contact', 'ContactController@create')->name('about.contact.create');
Route::post('/contact/confirm', 'ContactController@confirm')->name('about.contact.confirm');
Route::post('/contact/send', 'ContactController@send')->name('about.contact.send');

//ご利用ガイド
Route::get('/guide', 'AboutController@guide')->name('about.guide');

//利用規約
Route::get('/rule', 'AboutController@rule')->name('about.rule');

//表現を探す
Route::get('/search','PhraseSearchController@index')->name("search.index");

//表現の検索結果
Route::get('/search_phrases','PhraseSearchController@search')->name("search.result");//->name("search_phrase.search");

////////////////////guest/////////////////////

//表現一覧
Route::get('/phrase','Guest\GuestPhraseController@index')->name("phrase.index");

//カテゴリ
Route::get('/phrase/category/{category}','Guest\GuestPhraseController@category')->name("phrase.category");

//タグ
Route::get('/phrase/tag/{tag}','Guest\GuestPhraseController@tag')->name("phrase.tag");

//表現詳細
Route::get('/phrase/{id}','Guest\GuestPhraseController@show')->name("phrase.show");

//イベント
Route::get('/event','Guest\GuestEventController@index')->name("event.index");

//イベントページネント
Route::get('/event/status/{status}','Guest\GuestEventController@index')->name("event.index.status");

//イベント詳細
Route::get('/event/detail/{event_id}','Guest\GuestEventController@detail')->name("event.detail");

//エントリー詳細
Route::get('/event/post/detail/{event_post_id}','Guest\GuestEventController@postDetail')->name("event.post.detail");

//エントリー投票
//Route::get('/event/vote/{post_id}',	'Guest\GuestEventController@voteConfirm')->name("event.vote");//resources/views/guest/event/vote.blade.php
//Route::post('/event/vote/{event_id}/{post_id}',	'Guest\GuestEventController@doVote')->name("event.doVote");//resources/views/guest/event/vote.blade.php
Route::get('/event/vote/{event_id}/{event_post_id}',	'Guest\GuestEventController@vote')->name("event.vote");//resources/views/guest/event/vote.blade.php

////////////////////guest/////////////////////
//});
//ここから先は認証が必要
//標準の認証を使う
Auth::routes();

/////////////////////user/////////////////////

Route::group(['middleware' => ['auth']], function(){//,'simple.auth'

    //MyMenu
    Route::get('/home', 'HomeController@index')->name('home');

    //プロフィール情報(設定)
	Route::get('/user/info/','User\UserInfoController@index')->name("user_info.index");

    //ログインネームの変更
	Route::get('/user/reset/name/','User\UserInfoController@nameEdit')->name("user_name.edit");//user_info.name
	
	Route::post('/user/reset/name/','User\UserInfoController@nameUpdate')->name("user_name.update");

    //メールアドレスの変更
	Route::get('/user/reset/email/','User\UserInfoController@emailEdit')->name("user_email.edit");

	Route::post('/user/reset/email/','User\UserInfoController@emailUpdate')->name("user_email.update");

    //パスワードの変更
	Route::get('/user/reset/password/','User\UserInfoController@passwordEdit')->name("user_password.edit");

	Route::post('/user/reset/password/','User\UserInfoController@passwordUpdate')->name("user_password.update");
    
    //退会する
	Route::get('/user/info/delete/','User\UserInfoController@delete_confirm')->name("user_info.delete_confirm");//user.profile.delete_confirm

	Route::post('/user/info/delete/{id}','User\UserInfoController@delete')->name("user_info.delete");

    //パスワードリセット？
    Route::get('/reset', function () {
        return view('auth.passwords.reset')->name('password.request');
    });

	//表現作成
	Route::get('/user/phrase/create', 'User\UserPhraseController@create')->name("user.phrase.create");
	Route::post('/user/phrase/create', 'User\UserPhraseController@store')->name("user.phrase.store");

    //自分の表現一覧
    Route::get('/user/phrase', 'User\UserPhraseController@index')->name("user.phrase.index");

    //
    //Route::get('/user/show/{id}', 'User\UserPhraseController@show')->name('user.phrase.show');

    //表現編集
    Route::get('/user/phrase/{id}', 'User\UserPhraseController@edit')->name("user.phrase.edit");
    Route::post('/user/phrase/{id}', 'User\UserPhraseController@update')->name("user.phrase.update");

    //表現削除
    Route::post('/user/phrase/delete/{id}', 'User\UserPhraseController@destroy')->name("user.phrase.destroy");

    //機能
	//Do Like ブックマークする
	Route::get('/user/phrase/like/{id}','User\UserPhraseLikeController@doLike');

    //ブックマーク(しおり)
    Route::get('/user/bookmark_list','User\UserPhraseBookmarkListController@index')->name("user.user_bookmark_list");

    //イベント作成
    Route::get('/user/event/create', 'User\UserEventController@create')->name("user.event.create");
    Route::post('/user/event/create', 'User\UserEventController@store')->name("user.event.store");

    //イベントエントリー//エントリー作成
	Route::get('/user/event/post/{event_id}', 'User\UserEventController@post')->name("user.event.post");
	Route::post('/user/event/post/{event_id}', 'User\UserEventController@postDone')->name("user.event.postDone");

});
/////////////////////user/////////////////////

/////////////////////admin/////////////////////
//管理側 admin

//管理側ログイン
Route::get('/admin/login', 'Admin\AdminLoginController@showLoginform')->name("admin/login");
Route::post('/admin/login', 'Admin\AdminLoginController@login')->name("admin/login");

Route::group(['middleware' => ['auth.admin']], function () {
	
	//管理側トップ
	Route::get('/admin', 'Admin\AdminController@index')->name("admin.top");
	//Route::get('/admin/top', 'Admin\AdminController@index')->name("admin.top");

	//phrase
	Route::get('/admin/phrase', 'Admin\AdminPhraseController@index')->name("admin.phrase.index");
	Route::get('/admin/phrase/create', 'Admin\AdminPhraseController@create')->name("admin.phrase.create");
	Route::post('/admin/phrase/create', 'Admin\AdminPhraseController@store')->name("admin.phrase.store");
	Route::get('/admin/phrase/{id}', 'Admin\AdminPhraseController@edit')->name("admin.phrase.edit");
	Route::post('/admin/phrase/{id}', 'Admin\AdminPhraseController@update')->name("admin.phrase.update");
	Route::post('/admin/phrase/delete/{id}', 'Admin\AdminPhraseController@destroy')->name("admin.phrase.destroy");
	
	//phraseCategory
	Route::get('/admin/phrase_category', 'Admin\AdminPhraseCategoryController@index')->name("admin.phrase_category.index");
	Route::get('/admin/phrase_category/create', 'Admin\AdminPhraseCategoryController@create')->name("admin.phrase_category.create");
	Route::post('/admin/phrase_category/create', 'Admin\AdminPhraseCategoryController@store')->name("admin.phrase_category.store");
	Route::get('/admin/phrase_category/{id}', 'Admin\AdminPhraseCategoryController@edit')->name("admin.phrase_category.edit");
	Route::post('/admin/phrase_category/{id}', 'Admin\AdminPhraseCategoryController@update')->name("admin.phrase_category.update");
	Route::post('/admin/phrase_category/delete/{id}', 'Admin\AdminPhraseCategoryController@destroy')->name("admin.phrase_category.destroy");
	
	//baseCategory
	// Route::get('/admin/base_category', 'Admin\AdminBaseCategoryController@index')->name("admin.base_category.index");
	// Route::get('/admin/base_category/create', 'Admin\AdminBaseCategoryController@create')->name("admin.base_category.create");
	// Route::post('/admin/base_category/create', 'Admin\AdminBaseCategoryController@store')->name("admin.base_category.store");
	// Route::get('/admin/base_category/{id}', 'Admin\AdminBaseCategoryController@edit')->name("admin.base_category.edit");
	// Route::post('/admin/base_category/{id}', 'Admin\AdminBaseCategoryController@update')->name("admin.base_category.update");
	// Route::post('/admin/base_category/delete/{id}', 'Admin\AdminBaseCategoryController@destroy')->name("admin.base_category.destroy");

	//event
	//イベント
	Route::get('/admin/event','Admin\AdminEventController@index')->name("admin.event.index");

	//イベントページネント
	Route::get('/admin/event/status/{status}','Admin\AdminEventController@index')->name("admin.event.index.status");

	//イベント詳細
	Route::get('/admin/event/detail/{event_id}','Admin\AdminEventController@detail')->name("admin.event.detail");

	//エントリー詳細
	Route::get('/admin/event/post/detail/{event_post_id}','Admin\AdminEventController@postDetail')->name("admin.event.post.detail");

	//エントリー投票
	//Route::get('/event/vote/{post_id}',	'Guest\GuestEventController@voteConfirm')->name("event.vote");//resources/views/guest/event/vote.blade.php
	//Route::post('/event/vote/{event_id}/{post_id}',	'Guest\GuestEventController@doVote')->name("event.doVote");//resources/views/guest/event/vote.blade.php
	Route::get('/admin/event/vote/{event_id}/{event_post_id}',	'Admin\AdminEventController@vote')->name("admin.event.vote");//resources/views/guest/event/vote.blade.php

	//イベント作成
	Route::get('/admin/event/create', 'Admin\AdminEventController@create')->name("admin.event.create");
	Route::post('/admin/event/create', 'Admin\AdminEventController@store')->name("admin.event.store");

	//イベントエントリー//エントリー作成
	Route::get('/adminevent/post/{event_id}', 'Admin\AdminEventController@post')->name("admin.event.post");
	Route::post('/adminevent/post/{event_id}', 'Admin\AdminEventController@postDone')->name("admin.event.postDone");


	//ユーザー一覧
	//Route::get('/admin/user_list', 'admin\ManageUserController@showUserList')->name('admin/user_list');
	//ユーザー詳細
	//Route::get('/admin/user/{id}', 'admin\ManageUserController@showUserDetail');

	//ログアウト実行
	Route::post('/admin/logout', 'Admin\AdminLogoutController@logout')->name('admin/logout');
	
});

/////////////////////admin/////////////////////

//エラー画面
// HTTPステータスコードを引数に、該当するエラーページを表示させる
Route::get('error/{code}', function ($code) {
	abort($code);
  });

// Route::get('error/404', function () {
//     return view('errors.404');
// });
