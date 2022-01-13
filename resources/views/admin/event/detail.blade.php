@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.event.detail',$event) }}

    <div class="row">
        <div class="col-sm-12">
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }} 
            </div>
            @endif
        </div>
    </div>
</div>
<!-- admin.event.create
admin.event.post.detail
admin.event.vote
admin.event.post -->
<!-- event -->
<div class="container">
    <div class="row">
        <!-- @//auth -->
        <!-- <div class="event_post" id="event_post" >
            <a href="{{-- route('admin.event.post', $event->id) --}}">
                <i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントエントリー"></i>
            </a>
        </div> -->
        <!--  -->
        <!-- <div>
            <a style="margin: 15px;" href="{{-- route('admin.event.post', $event->id) --}}" class="btn btn-primary">イベントエントリー</a>
        </div> -->
        <!-- @//endauth -->
        <div class="col-sm-12">
            <div class="card base-card">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item">イベントタイプ: {{-- $event->event_type --}}</li> -->
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

<!--  -->
<div class="container"><!-- container-fluid -->
    <div class="row">
        <!-- @//auth -->
        <!-- <div class="event_post" id="event_post" >
            <a href="{{-- route('admin.event.post', $event->id) --}}">
                <i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントエントリー"></i>
            </a>
        </div> -->
        <!--  -->
        <div>
            <a style="margin: 15px;" href="{{ route('admin.event.post', $event->id) }}" class="btn btn-outline-primary">イベントエントリー</a>
        </div>
        <!-- @//endauth -->
 
        <p><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>
        @if(count($eventPost) < 1)
        <p>エントリーはありません</p>
        @endif

        @foreach($eventPost as $post)
        <div class="card post-item text-center mb-5 pop-card"><!-- <div class="card base-card post-item mb-5"> -->
            
            @include("parts.event.post_info", ["post" => $post])

            @if($post->user_id !== null)
            <hr/>
            <div class="vote-function mb-2">
            @if(isset($votes[$post->id]) && $votes[$post->id])                       
                <a class="btn btn-info" href="{{ url('admin.event.vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                    <i class="bi bi-hand-thumbs-up-fill"></i> いいね！ <!--投票済み-->
                </a>
            @else
                <a class="btn btn-light" href="{{ url('admin.event.vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) }}">
                    <i class="bi bi-hand-thumbs-up"></i> いいね！する <!--投票-->
                </a>
            @endif
            </div><!--vote-function -->
            @endif

            <!--  -->
            {{--@if($post->user_id !== Auth::id())--}}
            <!-- <div> -->
                <!--$likes[$phrase->id] $likes[$like->phrase_id]-->
                {{--@if($vote && $vote->vote == 1)--}}
                <!-- <a class="btn btn-primary" href="{{-- url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) --}}">
                    <i class="bi bi-hand-thumbs-up-fill"></i> いいね! 
                </a> --><!--投票済み-->
                {{--@else--}}
                <!-- <a class="btn btn-outline-primary" href="{{-- url('/event/vote', ['event_id' => $post->event_id, 'event_post_id' => $post->id]) --}}">
                    <i class="bi bi-hand-thumbs-up"></i> いいね!する 
                </a> --><!--投票-->
                {{--@endif--}}
            <!-- </div> -->
            {{--@endif--}}
            <!--  -->
        </div>
        @endforeach
    
        {{ $eventPost->links() }}

    </div>
</div>

<hr/>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.top')}}">管理者トップ</a>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.event.index')}}">管理者イベント一覧</a>

@endsection('content')