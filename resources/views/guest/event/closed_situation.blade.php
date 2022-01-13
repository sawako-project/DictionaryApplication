@extends('layouts.dictionary',["title"=>"U_Dectionary"])
 
{{--@section('header-title', 'イベント終了(結果)')--}}
 
@section('content')
 
{{ Breadcrumbs::render('event.detail', $event) }}
 
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card base-card">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                <!--  -->
                <!-- {{--@include("parts.event.event_info", ["event" => $event])--}} -->
                <!--  -->
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
            <!--  -->
            <!-- <div class="card event-item text-center mb-5 pop-card">
                <div class="card-body"> -->
                    <!-- <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容): {{-- $event->event_text --}}</h5> -->
                    <!-- <h5 class="card-title">イベント情報</h5>
                    <p class="card-text">お題・テーマ: ｢<strong>{{-- $event->event_text --}}</strong>｣<span>な状況(時)の表現</span></p>
                    <p class="card-text">イベントタイプ: {{-- $event->eventLabel() --}}</p>
                    <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者: {{-- ($event->user) ? $event->user->name : "-"--}}</p>
                    <p class="card-text">
                        <time datetime="{{-- $event->updated_at->format('Y-m-d H:i:s') --}}">作成日時: {{-- $event->updated_at->format("Y-m-d H:i:s") --}}</time>
                    </p>
                    <p class="card-text">イベント終了日時: {{-- $event->schedule_end --}}</p>
                    <p><span class="badge badge-primary">エントリー数: {{-- $event->posts->count() --}}件</span></p>
                </div>
            </div> -->
            <!--  -->
        </div>
    </div>
</div>
 
<div class="heading">
    <h2><strong><span class="under">ランキング(投票結果)</span></strong></h2>
</div>
 
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <p class="text-center"><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>

            @if(count($eventPosts) < 1)
            <p>エントリーがありませんでした。</p>
            @endif

            @if(count($eventPosts) >= 1)
            <p></p>
            <i class="bi bi-award fa-2x"></i>

            @foreach($eventPosts as $post)
            <div class="card post-item text-center mb-5 pop-card"><!-- <div class="card base-card post-item mb-5"> -->
            
                @include("parts.event.post_info", ["post" => $post])
              <!--  -->
            <!--  -->
                <!-- <p><i class="bi bi-hand-thumbs-up-fill"></i>いいね!{{-- $post->votes_count --}}個</p> -->
                <p><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!: {{ $post->votes_count }}個</span></p>
            </div>
            @endforeach

            {{ $eventPosts->links() }}
            @endif

        </div>
    </div>
</div>
 
<!-- <hr> -->
<!-- <a href="{{-- route('event.index')--}}">戻る</a> -->
 
@endsection('content')
