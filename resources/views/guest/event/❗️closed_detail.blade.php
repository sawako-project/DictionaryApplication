@extends('layouts.dictionary',["title"=>"U_Dectionary"])

@section('content')

<!-- $eventPosts -->

<!-- event -->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">イベント詳細</h1>
            <!-- @//auth -->
            <div class="event_post" id="event_post">

                <a href="{{ route('user.event.post', $event->id) }}"><i class="far fa-plus-square fa-3x fa-pull-right"   data-bs-toggle="tooltip" data-bs-placement="top" title="イベントエントリー"></i></a><!--style="margin: 15px;" 表現追加 class="btn btn-primary"--><!-- <i class="fas fa-plus-circle fa-3x fa-pull-right"></i> -->
            <!-- <a style="margin: 15px;" href="{{-- route('user.base_category.index')--}}" class="btn btn-primary">分類一覧</a> -->
            </div>
            <!-- @//endauth -->
            
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID： {{$event->id}} </li>
                <li class="list-group-item">イベント内容： 
                    {!! nl2br(e($event->event_text)) !!}
                </li>
                <!-- <//?php
                dd($phrase->phraseCategories->phrase_category);
                ?> -->

                <!-- @//foreach($phrase->phraseCategories as $phraseCategory) -->
                <li class="list-group-item">イベントタイプ： {!! nl2br(e($event->event_type)) !!}{{-- $phraseCategory->phrase_category --}}</li>
                <!-- @//endforeach -->

                <li class="list-group-item">イベント終了： 
                    {!! nl2br(e($event->schedule_end)) !!}
                <!-- @//foreach($phrase->phraseTags as $phraseTag) -->
                <!-- {{-- $phraseTag->phrase_tag --}}<span>,</span> -->
                <!-- @//endforeach -->
                </li>
            </ul>
    
            <!-- @//if($editable)
            <div class="card mt-3">
                <div class="card-body">
                    <a href="{{-- url('/phrase/edit/'.$phrase->id) --}}" class="btn btn-primary">
                        <i class="fa fa-edit"></i>
                        編集
                    </a>
                </div>
            </div>
            @//endif -->
        </div>
    </div>
</div>


<p>イベント終了</p>


<p>グラフで反映</p>
<p>表？ばー？</p>
<p>一位に王冠</p>
<p>count,voteのcount多い順に</p>
<div class="container">
    <div class="row">
         <!-- @//foreach($event->posts as $post) -->
         @foreach($eventPosts as $post)
        <div class="col-sm-12">
            <div class="card post-item">
                <div class="card-body">
                    <ul>
                        <li>{{ $post->id }}</li>
                        <li>{{ $post->post_text }}</li>
                        <li>{{ $post->event_id }}</li>
                        <li>{{ $post->votes_count }}</li><!--  -->
                        <!-- @//if ($post->votes->count() >= 1)
                        <p><span class="badge badge-primary">コメント：{{-- $post->votes->count() --}}件</span></p>
                        @//endif -->
                        <!--<li><time datetime="{{-- $post->created_at->format('Y-m-d H:i:s') --}}">{{-- $post->created_at->format("Y-m-d H:i:s") --}}</time></li>
                        <li><time datetime="{{-- $post->updated_at->format('Y-m-d H:i:s') --}}">{{-- $post->updated_at->format("Y-m-d H:i:s") --}}</time></li> -->
                    </ul>
                    <!-- <a href="{{-- route('event.vote', $post->id) --}}">Vote</a> -->
                </div>
            </div>
        </div>
        @endforeach
        <!-- </div> -->

        {{ $eventPosts->links() }}
    </div>
</div>

   

<hr>
<a href="{{ route('event.index')}}">戻る</a>




@endsection('content')
