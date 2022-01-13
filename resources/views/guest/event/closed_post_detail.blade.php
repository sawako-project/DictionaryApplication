@extends('layouts.dictionary',["title"=>"U_Dectionary"])
 
{{--@section('header-title', 'エントリー詳細')--}}
 
@section('content')
 
{{ Breadcrumbs::render('event.post.detail', $eventPost) }}
{{-- Breadcrumbs::render('event.post.detail', ['event' => $event, 'eventPost' => $eventPost] ) --}}
 
<!-- <div class="heading">
           <h2><strong><span class="under">エントリー詳細</span></strong></h2>
       </div> -->
 
<!-- エントリー -->
<div class="container">
   <div class="row">
       <div class="col-sm-12">
 
           <div class="card base-card post-item mb-5">
               <div class="card-header">エントリー詳細</div>
               <div class="card-body">
                   <ul class="list-group list-group-flush">
                       <li class="list-group-item">エントリー: <strong>{{ $eventPost->post_text }}</strong></li>
                       <li class="list-group-item"><i class="bi bi-person-fill"></i>エントリーユーザー: {{ ($eventPost->user) ? $eventPost->user->name : "-"}}</li>
                       <li class="list-group-item"><time datetime="{{ $eventPost->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $eventPost->updated_at->format("Y-m-d H:i:s") }}</time></li>
                       <li class="list-group-item"><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!: {{ $eventPost->votes->count() }}個</span></li>
                       <!-- <li class="list-group-item"><i class="bi bi-hand-thumbs-up-fill"></i>いいね!{{-- $post->votes_count --}}個</li>
                       <li class="list-group-item"><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!{{-- $post->votes_count --}}個</span></li> -->
                   </ul>
               </div>
 
               <!--  -->
         

<!--  -->
 
           <!-- <div class="card post-item text-center mb-5 pop-card">
               <div class="card-body"> -->
                   <!-- <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容): {{-- $event->event_text --}}</h5> -->
                   <!-- <h5 class="card-title">エントリー詳細</h5>
                   <p class="card-text">エントリー: <strong>{{-- $eventPost->post_text --}}</strong></p>
                   <p class="card-text"><i class="bi bi-person-fill"></i>エントリーユーザー: {{-- ($eventPost->user) ? $eventPost->user->name : "-"--}}</p>
                   <p class="card-text">
                       <time datetime="{{-- $eventPost->updated_at->format('Y-m-d H:i:s') --}}">作成日時: {{-- $eventPost->updated_at->format("Y-m-d H:i:s") --}}</time>
                   </p> -->
                   <!-- <p class="card-text"><i class="bi bi-hand-thumbs-up-fill"></i>いいね!{{-- $post->votes_count --}}個</p>
                   <p><i class="bi bi-hand-thumbs-up-fill"></i><span class="badge badge-primary">いいね!{{-- $post->votes_count --}}個</span></p> -->
               <!-- </div>
               <hr/> -->
               <!-- {{--@if($eventPost->user_id !== Auth::id())--}} -->
               <!-- <div> -->
                   <!--$likes[$phrase->id] $likes[$like->phrase_id]-->
                   <!-- {{--@if($vote && $vote->vote == 1)--}} -->
                   <!-- <a class="btn btn-primary" href="{{-- url('/event/vote', ['event_id' => $eventPost->event_id, 'event_post_id' => $eventPost->id]) --}}">
                       <i class="bi bi-hand-thumbs-up-fill"></i> いいね!
                   </a> -->
                   <!-- {{--@else--}} -->
                   <!-- <a class="btn btn-outline-primary" href="{{-- url('/event/vote', ['event_id' => $eventPost->event_id, 'event_post_id' => $eventPost->id]) --}}">
                       <i class="bi bi-hand-thumbs-up"></i> いいね!する
                   </a> -->
                   <!-- {{--@endif--}} -->
               <!-- </div> -->
               <!-- {{--@endif--}} -->
           <!-- </div> -->
<!--  -->  
           </div>
       </div>
   </div>
</div>
 
<!-- <hr/>
<p><a href="{{-- url('/event/detail/'.$eventPost->event_id) --}}">イベント: {{-- $eventPost->event->event_text --}}に戻る</a></p>
<p><a href="{{-- url('/event/detail/'.$eventPost->event_id) --}}">エントリー: {{-- $eventPost->post_text --}}に戻る</a></p>
<a href="{{-- url('/event') --}}">イベント一覧に戻る</a> -->
 
@endsection('content')
