@extends('layouts.dictionary',["title"=>"U_Dectionary"])

{{--@section('header-title', 'エントリー詳細')--}}

@section('content')

{{ Breadcrumbs::render('event.post.detail', $eventPost) }}

<!-- <div class="heading">
            <h2><strong><span class="under">エントリー詳細</span></strong></h2>
        </div> -->

<!-- エントリー -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card base-card">
                <div class="card-header">エントリー詳細</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">エントリーID: {{$eventPost->id}}</li>
                        <li class="list-group-item">エントリー: strong>{{ $eventPost->post_text }}</strong></li>
                        <li class="list-group-item"><i class="bi bi-person-fill"></i>エントリー者: {{ ($eventPost->user) ? $eventPost->user->name : "-"}}</li>
                        <li class="list-group-item"><time datetime="{{ $eventPost->updated_at->format('Y-m-d H:i:s') }}">作成日時: { $eventPost->updated_at->format("Y-m-d H:i:s") }}</time></li>
                    </ul>
                </div>
            </div>

            @if($eventPost->user_id !== Auth::id())
            <div>
                <!--$likes[$phrase->id] $likes[$like->phrase_id]-->
                @if($vote && $vote->vote == 1)
                <a class="btn btn-primary" href="{{ url('/event/vote', ['event_id' => $eventPost->event_id, 'event_post_id' => $eventPost->id]) }}"><!--  class="btn btn-light"-->
                    <i class="bi bi-hand-thumbs-up-fill"></i> いいね! <!--投票済み-->
                </a>
                @else
                <a class="btn btn-outline-primary" href="{{ url('/event/vote', ['event_id' => $eventPost->event_id, 'event_post_id' => $eventPost->id]) }}">
                    <i class="bi bi-hand-thumbs-up"></i> いいね!する <!--投票-->
                </a>
                @endif
            </div>
            @endif
            
        </div>
    </div>
</div>

<hr/>
<p><a href="{{ url('/event/detail/'.$eventPost->event_id) }}">エントリー: { $eventPost->event->event_text }}に戻る</a></p>
<p><a href="{{ url('/event/detail/'.$eventPost->event_id) }}">イベント: { $eventPost->post_text }}に戻る</a></p>
<hr/>
<a href="{{ url('/event') }}">イベント一覧に戻る</a>

@endsection('content')