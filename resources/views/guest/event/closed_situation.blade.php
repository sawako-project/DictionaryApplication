@extends('layouts.dictionary',["title"=>"U_Dectionary"])

{{--@section('header-title', 'イベント終了(結果)')--}}

@section('content')

{{ Breadcrumbs::render('event.post.detail', $event) }}

<!-- <div class="heading">
    <h2><strong><span class="under">イベント終了(結果)</span></strong></h2>
</div> -->

<div class="container">
    <div class="row">
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
    <h2><strong><span class="under">ランキング(投票結果)</span></strong></h2>
</div>
<p><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></p>

<div class="container">
    <div class="row">

        @if(count($eventPosts) < 1)
        <p>ないよ</p>
        @endif

        @if(count($eventPosts) >= 1)
        <p>あるよ</p>
        <i class="bi bi-award fa-2x"></i>
        @foreach($eventPosts as $post)
        <div class="col-sm-12">
            <div class="card post-item mb-5 pop-card">
                <div class="card-body">
                    <ul>
                        <li><i class="bi bi-person-fill"></i>{{ ($post->user) ? $post->user->name : "-"}}</li>
                        <li>{{ $post->id }}</li>
                        <li>{{ $post->post_text }}</li>
                        <li>{{ $post->event_id }}</li>
                        <li><i class="bi bi-hand-thumbs-up-fill"></i> いいね!{{ $post->votes_count }}個</li>
                        <!--<li><time datetime="{{-- $post->updated_at->format('Y-m-d H:i:s') --}}">{{-- $post->updated_at->format("Y-m-d H:i:s") --}}</time></li> -->
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        {{ $eventPosts->links() }}
        @endif

    </div>
</div>

<hr>
<a href="{{ route('event.index')}}">戻る</a>

@endsection('content')