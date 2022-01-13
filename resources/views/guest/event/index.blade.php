@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])
 
@section('header-title', 'イベントメニュー')

@section('content')

@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }} 
</div>
@endif

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
            <div class="card text-center mb-5 base-card">
                <div class="card-body">
                    <p>イベントのグループは｢イベントの掲示板｣、｢開催中のイベント｣、｢まもなく終了するイベント｣、｢終了したイベント｣に分けられています。</p>
                    <hr/>
                    <p>｢イベントの掲示板｣は｢開催中のイベント｣、｢まもなく終了するイベント｣、｢終了したイベント｣を含んだ今までのイベントを見れます。</p>
                    <hr/>
                    <p>｢開催中のイベント｣はイベントが開催中で、ユーザーの方はそのイベントへのエントリーと他のエントリーへの投票ができます。非ユーザーの方はエントリーへの投票のみできます。</p>
                    <hr/>
                    <p>｢まもなく終了するイベント｣はエントリーやそれに対しての投票の受付がまもなく終了するイベントが集められます。イベントの終了日時の二日前になるとここに表示されます。</p>
                    <hr/>
                    <p>｢終了したイベント｣は開催が終了したイベントで、エントリーに対する投票数の結果が確認できます。</p>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<div class="event_create" id="event_create">
    <!-- <a href="{{-- route('user.event.create') --}}"><i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントを作る"></i></a> -->
    <a href="{{ route('user.event.create') }}" class="btn btn-outline-primary text-nowrap mb-3">イベントを作る</a>
</div>
@endauth

<!-- @auth
<div class="event_create" id="event_create">
   <a href="{{-- route('user.event.create') --}}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントを作る"></i></a>
 </div>
@endauth -->
 
<br/>

@isset($events)
<div class="heading">
    <h2><strong><span class="under">イベントの掲示板</span></strong></h2>
</div>
@if(count($events) < 1)
<p>イベントはありません</p>
@endif

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        @foreach($events as $event)
        <div class="col-sm-12">
            
            @include("parts.event.event_info", ["event" => $event])
            
        </div>
        @endforeach
    </div>
</div>

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

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        @foreach($events_hold as $event)
        <div class="col-sm-12">

        @include("parts.event.event_info", ["event" => $event])

        </div>
        @endforeach
    </div>
</div>

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

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
    @foreach($event_soonEnd as $event)
        
        @include("parts.event.event_info", ["event" => $event])

    @endforeach
        </div>
    </div>
</div>

<div class='pagination justify-content-center'>
    {{ $event_soonEnd->links() }}
</div>
@endisset

@isset($events_end)
<div class="heading">
    <h2><strong><span class="under">終了したイベント</span></strong></h2>
</div>

@if(count($events_end) < 1)
<p>終了したイベントはありません</p>
@endif

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        @foreach($events_end as $event)
        <div class="col-sm-12">

        @include("parts.event.event_info", ["event" => $event])

        </div>
        @endforeach
    </div>
</div>

<div class='pagination justify-content-center'>
    {{ $events_end->links() }}
</div>
@endisset

<style type="text/css">

.pagination {
    margin-top:24px;
}

</style>

<hr>
<a class="btn btn-outline-primary" href="{{ url('/event') }}">イベントメニューに戻る</a>

@endsection('content')