@extends('layouts.dictionary',["title"=>"Dectionary"])

@section('header-title', 'ブックマーク')

@section('content')

<div class="container">
    <div class="row py-3">
      
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
        @endif

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
    </div><!--<div class="row">-->

</div>

<div class='pagination justify-content-center'>

{{ $phraseLikes->links() }}

    <style type="text/css">

    .pagination {
        /*display: inline-block;*/
    }

    .pagination .page-item {
        color: black;
        float: center;
        padding: 8px 16px;
        text-decoration: none;
        list-style: none;
    }

    </style>
</div>

@endsection('content')