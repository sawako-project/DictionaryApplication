@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

{{--@section('header-title', 'イベント詳細')--}}

@section('content')

{{ Breadcrumbs::render('event.detail', $event) }}

<!-- event -->
<div class="container">
    <div class="row">
        <!-- @//auth -->
        <div class="event_post" id="event_post" >
            <a href="{{ route('user.event.post', $event->id) }}">
                <!--style="margin: 15px;" class="btn btn-primary" <i class="bi bi-plus-square fa-pull-right fa-2x></i>-->
                <i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントエントリー"></i>
            </a>
        </div>
        <!-- @//endauth -->
        <div class="col-sm-12">
            <div class="card base-card">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                    @include("parts.event.event_info", ["event" => $event])
                </div>
            </div>
        </div>
    </div>
</div>

<div class="heading">
    <h2><strong><span class="under">エントリー</span></strong></h2>
</div>

<!-- @//auth -->
<div class="event_post" id="event_post" >
    <a href="{{ route('user.event.post', $event->id) }}">
<!--style="margin: 15px;" class="btn btn-primary" <i class="bi bi-plus-square fa-pull-right fa-2x></i> -->
        <i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントエントリー"></i>
    </a>
</div>
<!-- @//endauth -->

<p><span class="badge badge-primary">エントリー数：{{ $event->posts->count() }}件</span></p>
@if(count($eventPost) < 1)
<p>エントリーはありません</p>
@endif

<!-- 横長 -->
<div class="container"><!-- container-fluid -->
    <div class="row">
    @foreach($eventPost as $post)
        <div class="col-sm-4">        
            <div class="card event-item text-center mb-5 pop-card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->post_text }}</h5>
                    <p class="card-text"><i class="bi bi-person-fill"></i>{{ ($post->user) ? $post->user->name : "-"}}</p>
                    <p class="card-text">
                        <small class="text-muted"><time datetime="{{ $post->updated_at->format('Y-m-d H:i:s') }}">作成日時：{{ $post->updated_at->format("Y-m-d H:i:s") }}</time></small>
                    </p>
                    <p class="card-text">
                    @if($post->phrase)
                        <a href="{{ route('user.phrase.show', ['id' => $post->phrase->id]) }} ">
                            {{ mb_strimwidth($post->phrase->phrase, 0, 13, "...") }}
                        </a>
                    @endif
                    </p>
                </div>
                <p class="text-right"><a href="{{ url('/event/post/detail', ['event_post_id' => $post->id]) }}">エントリー詳細<span><i class="bi bi-arrow-right-short"></i></span></a></p>
               
                @if($post->user_id == Auth::id())

                @else
                <div class="vote-function mb-2">
                    @if(isset($votes[$post->id]) && $votes[$post->id])                       
                    <a class="btn btn-primary" href="{{ url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                        <i class="bi bi-hand-thumbs-up-fill"></i> いいね！ <!--投票済み-->
                    </a>
                    @else
                    <a class="btn btn-outline-primary" href="{{ url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                        <i class="bi bi-hand-thumbs-up"></i> いいね！する <!--投票-->
                    </a>
                    @endif
                </div><!--vote-function -->
                @endif
                        
            </div>      
        </div>
    @endforeach
    </div>
</div>

{{ $eventPost->links() }}

<hr/>
<a href="{{ route('event.index')}}">戻る</a>

@endsection('content')