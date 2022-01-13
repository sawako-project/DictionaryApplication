@extends('layouts.dictionary',["title"=>"Dectionary"])

@section('header-title', 'ブックマーク')

@section('content')

<div class="container">
    <div class="row py-3">
    </div>

    @if(count($phraseLikes) < 1)
    <p>ブックマークがありません</p>
    @endif

    <div class="row">
        <div class="col-sm-12">
        @foreach($phraseLikes as $phrase)
            <div class="card mb-5 pop-card">
                <div class="card-header">{{ $phrase->phrase }}</div>
                <div class="card-body">
                    
                    @include("parts.phrase.phrase_info", ["phrase" => $phrase])

                    <div class="like-function">
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}" class="btn btn-light">
                            <i class="bi bi-bookmark-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

</div>

<div class='pagination justify-content-center'>
@component('parts.components.item_pager')
   @slot("item_list",$phraseLikes)
@endcomponent
</div>

@endsection('content')