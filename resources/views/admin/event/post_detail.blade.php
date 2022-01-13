@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.event.post.detail',$eventPost) }}

</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card base-card">
                <div class="card-header">エントリー詳細</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">エントリー: <strong>{{ $eventPost->post_text }}</strong></li>
                        <li class="list-group-item"><i class="bi bi-person-fill"></i>エントリーユーザー: {{ ($eventPost->user) ? $eventPost->user->name : "-"}}</li>
                        <li class="list-group-item"><time datetime="{{ $eventPost->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $eventPost->updated_at->format("Y-m-d H:i:s") }}</time></li>
                        <li class="list-group-item"><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!: {{ $eventPost->votes->count() }}個</span></li>
                    </ul>
                </div>

                @if($eventPost->event->schedule_end >= date("Y/m/d H:i:s")))
                @if($eventPost->user_id !== Auth::id())
                <hr/>
                <div class="text-center">
                    @if($vote && $vote->vote == 1)
                    <a class="btn btn-info" href="{{ url('admin.event.vote', ['event_id' => $eventPost->event_id, 'event_post_id' => $eventPost->id]) }}">
                        <i class="bi bi-hand-thumbs-up-fill"></i> いいね! <!--投票済み-->
                    </a>
                    @else
                    <a class="btn btn-light" href="{{ url('admin.event.vote', ['event_id' => $eventPost->event_id, 'event_post_id' => $eventPost->id]) }}">
                        <i class="bi bi-hand-thumbs-up"></i> いいね!する <!--投票-->
                    </a>
                    @endif
                </div>
                @endif
                @endif 
            </div> 
        </div>
    </div>
</div>

<hr/>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.top')}}">管理者トップ</a>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.event.index')}}">管理者イベント一覧</a>

@endsection('content')