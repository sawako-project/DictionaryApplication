@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.event.detail',$event) }}

</div>

<div class="heading">
    <h2><strong><span class="under">イベント終了</span></strong></h2>
</div>

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
            <div class="card post-item text-center mb-5 pop-card">
            
                @include("parts.event.post_info", ["post" => $post])
                <p><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!: {{ $post->votes_count }}個</span></p>
            </div>
            @endforeach

            {{ $eventPosts->links() }}
            @endif

        </div>
    </div>
</div>

<hr/>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.top')}}">管理者トップ</a>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.event.index')}}">管理者イベント一覧</a>

@endsection('content')