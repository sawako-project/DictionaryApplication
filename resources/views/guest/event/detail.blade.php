@extends('layouts.dictionary',["title"=>"U_Dectionary"])
 
{{--@section('header-title', 'イベント詳細')--}}
 
@section('content')
 
{{ Breadcrumbs::render('event.detail', $event) }}

<div class="container">
    <div class="row">
        <div class="col-sm-12"> 
            <div class="card base-card">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">お題・テーマ: <strong>{{ $event->event_text }}</strong>｣な状況(時)の表現</li>
                        <li class="list-group-item">イベントタイプ: {{ $event->eventLabel() }}</li>
                        <li class="list-group-item"><i class="bi bi-person-fill"></i> イベント発案者: {{ ($event->user) ? $event->user->name : "-"}}</li>
                        <li class="list-group-item"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $event->updated_at->format("Y-m-d H:i:s") }}</time></li>
                        <li class="list-group-item">イベント終了日時: {{ $event->schedule_end }}</li>
                        <li class="list-group-item"><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="heading">
    <h2><strong><span class="under">エントリー</span></strong></h2>
</div>

<div class="container">
    <div class="row">
        @auth
        <div class="post_create" id="post_create" >
            <!-- <a href="{{-- route('user.event.post', $event->id) --}}"><i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントエントリー"></i></a> -->
            <a href="{{ route('user.event.post', $event->id) }}" class="btn btn-outline-primary text-nowrap mb-3">イベントエントリー</a>
        </div>
        @endauth
 
        <p><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>
        @if(count($eventPost) < 1)
        <p>エントリーはありません</p>
        @endif

        @foreach($eventPost as $post)
        <div class="card post-item text-center mb-5 pop-card">
            
            @include("parts.event.post_info", ["post" => $post])

            @guest
            <hr/>
            <div class="vote-function mb-2">
            @if(isset($votes[$post->id]) && $votes[$post->id])                       
                <a class="btn btn-info" href="{{ url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                    <i class="bi bi-hand-thumbs-up-fill"></i> いいね！ <!--投票済み-->
                </a>
            @else
                <a class="btn btn-light" href="{{ url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                    <i class="bi bi-hand-thumbs-up"></i> いいね！する <!--投票-->
                </a>
            @endif
            </div>
            @endguest

            @auth
            @if($post->user_id !== Auth::id())
            <hr/>
            <div class="vote-function mb-2">
            @if(isset($votes[$post->id]) && $votes[$post->id])                       
                <a class="btn btn-info" href="{{ url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                    <i class="bi bi-hand-thumbs-up-fill"></i> いいね！ <!--投票済み-->
                </a>
            @else
                <a class="btn btn-light" href="{{ url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                    <i class="bi bi-hand-thumbs-up"></i> いいね！する <!--投票-->
                </a>
            @endif
            </div>
            @endif
            @endauth
        </div>
        @endforeach
    
        {{ $eventPost->links() }}

    </div>
</div>

<hr>
<a class="btn btn-outline-primary" href="{{ url('/event') }}">イベント一覧に戻る</a>
 
@endsection('content')
