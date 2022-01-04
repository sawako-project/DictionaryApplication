@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

{{--@section('header-title', 'イベント')--}}

@section('content')

 

@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif

<div class="event_create" id="event_create">
   <a href="{{ route('admin.event.create') }}"><i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントを作る"></i></a>
</div>

<div class="event_create" id="event_create">
   <a href="{{ route('admin.event.create') }}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントを作る"></i></a>
 </div>
 
<br/>
 

@isset($events)
<div class="heading">
   <h2><strong><span class="under">全てのイベント</span></strong></h2>
</div>
@if(count($events) < 1)
<p>イベントはありません</p>
@endif
 
<!-- 横長 -->
<div class="container"><!-- container-fluid -->

   <div class="row"><!-- row no-gutters -->
   @foreach($events as $event)
       <div class="col-sm-12">
           <div class="card event-item text-center mb-5 pop-card">
               <div class="card-body">
                   <h5 class="card-title">お題・テーマ：｢<strong>{{ $event->event_text }}</strong>｣<span>な状況(時)の表現</span></h5>
                   <p class="card-text"><i class="bi bi-person-fill"></i> イベント発案者：{{ ($event->user) ? $event->user->name : "-"}}</p>
                   <p class="card-text">終了日時：{{ $event->schedule_end }}</p>
                   <p class="card-text">
                       <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時：{{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
                   </p>
                   <p><span class="badge badge-primary">エントリー数：{{ $event->posts->count() }}件</span></p>
               </div>
               <p class="text-right"><a href="{{ url('/admin/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
           </div>
       </div>
       @endforeach
   </div>

</div>
<!-- 横長 -->
 
<div class='pagination justify-content-center'>
{{ $events->links() }}
</div>
@endisset

@isset($events_hold)
<div class="heading">
   <h2><strong><span class="under">開催中のイベント</span></strong></h2>
</div>
@if(count($events_hold) < 1)
<p>今開催しているイベントはありません</p>
@endif
 
<!-- 横長 -->
<div class="container"><!-- container-fluid -->
   <div class="row"><!-- row no-gutters -->
   @foreach($events_hold as $event)
       <div class="col-sm-12">
           <div class="card event-item text-center mb-5 pop-card">
               <div class="card-body">
                   <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容)：{{ $event->event_text }}</h5>
                   <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者：{{ ($event->user) ? $event->user->name : "-"}}</p>
                   <p class="card-text">終了日時：{{ $event->schedule_end }}</p>
                   <p class="card-text">
                       <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時：{{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
                   </p>
                   <p><span class="badge badge-primary">エントリー数：{{ $event->posts->count() }}件</span></p>
               </div>
               <p class="text-right"><a href="{{ url('/admin/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
           </div>
       </div>
       @endforeach
   </div>

</div>

<!-- 横長 -->
<div class='pagination justify-content-center'>
{{ $events_hold->links() }}
</div>
@endisset


@isset($event_soonEnd)
<div class="heading">
  <h2><strong><span class="under">まもなく終了するイベント</span></strong></h2>
</div>
@if(count($event_soonEnd) < 1)
<p>まもなく終了するイベントはありません</p>
@endif
<!-- 横長 -->
<div class="container"><!-- container-fluid -->
  <div class="row"><!-- row no-gutters -->
  @foreach($event_soonEnd as $event)
      <div class="col-sm-12">
          <div class="card event-item text-center mb-5 pop-card">
              <div class="card-body">
                  <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容)：{{ $event->event_text }}</h5>
                  <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者：{{ ($event->user) ? $event->user->name : "-"}}</p>
                  <p class="card-text">終了日時：{{ $event->schedule_end }}</p>
                  <p class="card-text">
                      <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時：{{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
                  </p>
                  <p><span class="badge badge-primary">エントリー数：{{ $event->posts->count() }}件</span></p>
              </div>
              <p class="text-right"><a href="{{ url('/admin/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
          </div>
      </div>
      @endforeach
  </div>

</div>
<!-- 横長 -->
<div class='pagination justify-content-center'>
{{ $event_soonEnd->links() }}
</div>
@endisset
 
@isset($events_end)
<div class="heading">
   <h2><strong><span class="under">終了したイベント履歴</span></strong></h2>
</div>
@if(count($events_end) < 1)
<p>終了したイベント履歴はありません</p>
@endif
 
<!-- 横長 -->
<div class="container"><!-- container-fluid -->
   <div class="row"><!-- row no-gutters -->
   @foreach($events_end as $event)
       <div class="col-sm-12">
           <div class="card event-item text-center mb-5 pop-card">
               <div class="card-body">
                   <h5 class="card-title">その作成するグループタグに入れる表現についての説明(内容)：{{ $event->event_text }}</h5>
                   <p class="card-text"><i class="bi bi-person-fill"></i>イベント発案者：{{ ($event->user) ? $event->user->name : "-"}}</p>
                   <p class="card-text">終了日時：{{ $event->schedule_end }}</p>
                   <p class="card-text">
                       <small class="text-muted"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時：{{ $event->updated_at->format("Y-m-d H:i:s") }}</time></small>
                   </p>
                   <p><span class="badge badge-primary">エントリー数：{{ $event->posts->count() }}件</span></p>
               </div>
               <p class="text-right"><a href="{{ url('/admin/event/detail', ['event_id' => $event->id]) }}">このイベントに参加する<span><i class="bi bi-arrow-right-short"></i></span></a></p>
           </div>
       </div>
       @endforeach
   </div>
</div>
<!-- 横長 -->
<div class='pagination justify-content-center'>
{{ $events_end->links() }}
</div>
@endisset
 
 
<style type="text/css">
/* .pagination {
    margin-top:24px;
} */
.pagination {
 /*display: inline-block;*/
}
.pagination .page-item {
 color: black;
 float: center;
 padding: 8px 16px;
 text-decoration: none;
 list-style: none;
}
</style>

<a class="btn btn-outline-primary" href="{{ url('/admin/event') }}">イベント全体</a>
<button><a href="{{route('admin.top')}}">管理者ダッシュボード</a></button>


@endsection('content')
