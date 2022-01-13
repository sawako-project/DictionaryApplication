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
            <!-- <div class="event_create" id="event_create"> -->
                <!-- <a href="{{-- route('admin.event.create') --}}"><i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="イベントを作る"></i></a> -->
                <!-- <button class="btn btn-outline-primary text-nowrap mb-3"><a href="{{-- route('admin.event.create') --}}" class="text-white">イベントを作る</a></button> -->
            <!-- </div> -->
            
            <br/>
        </div>
    </div>
</div>

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
        @isset($events)
            <div class="heading">
                <h2><strong><span class="under">全てのイベント</span></strong></h2>
            </div>
            @if(count($events) < 1)
            <p>イベントはありません</p>
            @endif
            @foreach($events as $event)     
            <!--  -->
                @include("parts.event.event_info", ["event" => $event])
            <!--  -->
            @endforeach
            <div class='pagination justify-content-center'>
            {{ $events->links() }}
            </div>
        @endisset
        </div>
    </div>
</div>

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
        @isset($events_hold)
            <div class="heading">
                <h2><strong><span class="under">開催中のイベント</span></strong></h2>
            </div>

            @if(count($events_hold) < 1)
            <p>今開催しているイベントはありません</p>
            @endif
            @foreach($events_hold as $event)
                <!--  -->
                @include("parts.event.event_info", ["event" => $event])
                <!--  -->
            @endforeach
            <div class='pagination justify-content-center'>
                {{ $events_hold->links() }}
            </div>
        @endisset
        </div>
    </div>
</div>

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
        @isset($event_soonEnd)
            <div class="heading">
                <h2><strong><span class="under">まもなく終了するイベント</span></strong></h2>
            </div>

            @if(count($event_soonEnd) < 1)
            <p>まもなく終了するイベントはありません</p>
            @endif
            @foreach($event_soonEnd as $event) 
                <!--  -->
                @include("parts.event.event_info", ["event" => $event])
                <!--  -->
            @endforeach
            <div class='pagination justify-content-center'>
                {{ $event_soonEnd->links() }}
            </div>
        @endisset
        </div>
    </div>
</div>

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
        @isset($events_end)
            <div class="heading">
                <h2><strong><span class="under">終了したイベント</span></strong></h2>
            </div>

            @if(count($events_end) < 1)
            <p>終了したイベントはありません</p>
            @endif
            @foreach($events_end as $event)
                <!--  -->
                @include("parts.event.event_info", ["event" => $event])
                <!--  -->
            @endforeach
            <div class='pagination d-flex justify-content-center'>
                {{ $events_end->links() }}
            </div>
        @endisset
        </div>
    </div>
</div>



<style type="text/css">

/* .pagination {
    margin-top:24px;
} */

.pagination {
    /*display: inline-block;*/
}

.pagination .page-item {
    color: black;
    float: center;
    /* padding: 8px 16px; */
    text-decoration: none;
    list-style: none;
}

</style>

<hr/>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.top')}}">管理者トップ</a>
<a class="btn btn-outline-primary mx-1" href="{{route('admin.event.index')}}">管理者イベント一覧</a>

@endsection('content')