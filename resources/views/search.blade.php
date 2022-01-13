{{--@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => true])--}}
@extends('layouts.dictionary',["title"=>"Dectionary"])

@section('header-title', '表現を探す')

@section('content')
<style>

/* .search-bar {
    font-family: 'Kiwi Maru', serif;
    width: 30%!important;
    text-align: center;
    margin: 0 auto;
    border-radius: 100px;
} */
/* .search-area {
    font-family: 'Kiwi Maru', serif;
    width: 30%!important;
    text-align: center;
    margin: 0 auto;
    border-radius: 100px;
} */

</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!--  -->
            <!-- <div class="search-bar">
                <div class="search-bar-inner">
                    <form action="{{-- url('/search_phrases')--}}" method="get" name="search">
                        <div id="search" class="form-group">
                            <div class="input-group">
                                <input type="text" name="keyword" value="{{-- @//$keyword --}}" class="form-control" placeholder="言葉を入力して検索する" >
                                <div class="input-group-append">
                                    <button class="btn btn-light text-dark" type="submit"><span><i class="fas fa-search"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
            <!--  -->
        {{--@include("layouts.parts.search-bar")--}}

        @include("layouts.parts.search-bar")
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="heading mb-5">
                <h2><strong><span class="under">最近作成(最新の)された表現(10件)</span></strong></h2>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">新規の表現(10件、総合)</div>
                <div class="card-body">   
                @if($phrases)      
                @foreach ($phrases as $phrase)
                    @include("parts.phrase.phrase_item", ["phrase" => $phrase])
                    <hr/>
                @endforeach
                @endif
                    <hr/>
                    <p class="text-right"><a href="{{ url('/phrase') }}">表現一覧(掲示板)を開く(もっと見る)<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                </div>
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="heading mb-5">
                <h2><strong><span class="under">カテゴリから探す</span></strong></h2>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">感情</div>
                <div class="card-body">
                @foreach($phraseCategories_feelings as $category)
                    <span><a href="{{ route('phrase.category', ['category' => $category->phrase_category ]) }}">
                    {{ $category->phrase_category }}({{ $category->phrases()->count() }})
                    </a></span>
                    <span class="mr-2"></span>
                @endforeach
                <hr/>
                </div>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">動作</div>
                <div class="card-body">
                @foreach($phraseCategories_actions as $category)
                    <span><a href="{{ route('phrase.category', ['category' => $category->phrase_category ]) }}">
                        {{ $category->phrase_category }}({{ $category->phrases()->count() }})
                    </a></span>
                    <span class="mr-2"></span>
                @endforeach
                <hr/>
                </div>
            </div>
            <div class="card mb-5 pop-card">
                <div class="card-header">表情</div>
                <div class="card-body">
                @foreach($phraseCategories_expressions as $category)
                    <span><a href="{{ route('phrase.category', ['category' => $category->phrase_category ]) }}">
                        {{ $category->phrase_category }}({{ $category->phrases()->count() }})
                    </a></span>
                    <span class="mr-2"></span>
                @endforeach
                <hr/>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')