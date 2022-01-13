@extends('layouts.dictionary',["title"=>"U_Dectionary"])

@section('header-title', '自分の表現')

@section('content')

<div class="container">
    <div class="row py-3">

    </div>
    
    <div class="phrase_create" id="phrase_create">
        <!-- <a href="{{-- route('user.phrase.create') --}}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="表現を作成する"></i></a> -->
        <a href="{{ route('user.phrase.create') }}" class="btn btn-outline-primary text-nowrap mb-3">表現を作成する</a>
        <!-- <div>
            <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}" class="btn btn-primary">表現を作成する</a>
        </div> -->
    </div>

    @if(count($phrases) < 1)
    <p>自分の表現がありません</p>
    @endif

    <div class="row">
        <div class="col-sm-12">
        @foreach($phrases as $phrase)
            <div class="card mb-5 pop-card">
                <div class="card-header">{{ $phrase->phrase }}</div>
                <div class="card-body">

                @include("parts.phrase.phrase_info", ["phrase" => $phrase])
                
                </div>
            </div>
        @endforeach
        </div>
    </div>
    
</div>

<div class='pagination justify-content-center'>
@component('parts.components.item_pager')
   @slot("item_list",$phrases)
@endcomponent
</div>

@endsection('content')