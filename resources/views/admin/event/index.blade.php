@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.event.index') }}

    <div class="row">
        <div class="col-sm-12">

            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }} 
            </div>
            @endif

            <h1 class="display-3">イベント一覧</h1>
            <div>
                <a style="margin: 15px;" href="{{ route('admin.event.create') }}" class="btn btn-primary">イベント作成</a>
                <!-- <a style="margin: 15px;" href="{{-- route('admin.phrase_category.index')--}}" class="btn btn-primary">カテゴリ一覧</a> -->
                <!-- <a style="margin: 15px;" href="{{-- route('admin.base_category.index')--}}" class="btn btn-primary">分類一覧</a> -->
            </div>
            <br/>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
        @isset($events)
            <div class="heading">
                <h2><strong><span class="under">全てのイベント</span></strong></h2>
            </div>
            @if(count($events) < 1)
            <p>イベントはありません</p>
            @endif

            @foreach($events as $event)
                @include("parts.event.event_info", ["event" => $event])
            @endforeach

            <div class='pagination justify-content-center'>
            @component('parts.components.item_pager')
                @slot("item_list",$events)
            @endcomponent
            </div>
        @endisset
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
        @isset($events_hold)
            <div class="heading">
                <h2><strong><span class="under">開催中のイベント</span></strong></h2>
            </div>

            @if(count($events_hold) < 1)
            <p>今開催しているイベントはありません</p>
            @endif

            @foreach($events_hold as $event)
                @include("parts.event.event_info", ["event" => $event])
            @endforeach

            <div class='pagination justify-content-center'>
            @component('parts.components.item_pager')
                @slot("item_list",$events_hold)
            @endcomponent
            </div>
        @endisset
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
        @isset($event_soonEnd)
            <div class="heading">
                <h2><strong><span class="under">まもなく終了するイベント</span></strong></h2>
            </div>

            @if(count($event_soonEnd) < 1)
            <p>まもなく終了するイベントはありません</p>
            @endif

            @foreach($event_soonEnd as $event) 
                @include("parts.event.event_info", ["event" => $event])
            @endforeach

            <div class='pagination justify-content-center'>
            @component('parts.components.item_pager')
                @slot("item_list",$event_soonEnd)
            @endcomponent
            </div>
        @endisset
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
        @isset($events_end)
            <div class="heading">
                <h2><strong><span class="under">終了したイベント</span></strong></h2>
            </div>

            @if(count($events_end) < 1)
            <p>終了したイベントはありません</p>
            @endif
            @foreach($events_end as $event)
            
                @include("parts.event.event_info", ["event" => $event])
            
            @endforeach
            <div class='pagination justify-content-center'>
            @component('parts.components.item_pager')
                @slot("item_list",$events_end)
            @endcomponent
            </div>
        @endisset
        </div>
    </div>
</div>

<hr/>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.top')}}">管理者トップ</a>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.event.index')}}">管理者イベント一覧</a>

@endsection('content')