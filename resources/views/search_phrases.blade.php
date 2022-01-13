@extends('layouts.dictionary',["title"=>"Dectionary"])

@section('header-title', '表現の検索結果')

@section('content')

<div class="container">
    <div class="row">
        
        @include("layouts.parts.search-bar")
        
        <div class="col-sm-12">
            <div class="card base-card">
            <div class="card-header">検索結果: ｢<strong>{{ $keyword }}</strong>｣についての表現</div>
                <div class="card-body">
                    <div class="item_box">
                        <p class="card-title"><strong><span style="border-bottom: solid 1px #000;">カテゴリ</span></strong></p>
                        @isset($category_result)
                        
                        @foreach($category_result as $category)
                        <p class="card-text "><a href="{{ route('phrase.category', ['category' => $category->phrase_category]) }}" class="btn btn-secondary">{{ $category->phrase_category }}</a></p>
                        <!-- <hr/> -->
                        @endforeach

                        @if(count($category_result) < 1)
                        <p>該当するカテゴリがありません</p>
                        @endif

                        @endisset
                    </div>
                    <hr/>
                    <div class="item_box">
                        <p class="card-title"><strong><span style="border-bottom: solid 1px #000;">タグ</span></strong></p>
                        @isset($tag_result)

                        @foreach($tag_result as $tag)
                        <p class="card-text "><a href="{{ route('phrase.tag', ['tag' => $tag->phrase_tag]) }}" class="btn btn-outline-secondary">{{ $tag->phrase_tag }}</a></p>
                        <!-- <hr/> -->
                        @endforeach

                        @if(count($tag_result) < 1)
                        <p>該当するタグがありません</p>
                        @endif

                        @endisset
                    </div>
                    <hr/>
                    <div class="item_box">
                        <p class="card-title "><strong><span style="border-bottom: solid 1px #000;">表現</span></strong></p>
                        @isset($phrase_result)
                        
                        @foreach($phrase_result as $phrase)
                        <p class="card-text"><a href="{{ route('phrase.show',['id' => $phrase->id]) }}">{{ $phrase->phrase }}</a></p>
                        <!-- <hr/> -->
                        @endforeach

                        @if(count($phrase_result) < 1)
                        <p>該当する表現がありません</p>
                        @endif

                        @endisset
                    </div>
                    <hr/>
                    <div class="item_box">
                        <p class="card-title"><strong><span style="border-bottom: solid 1px #000;">結果</span></strong></p>
                        @isset($results)

                        @foreach($results as $phrase)
                        <p class="card-text ">{{ $phrase->phrase }}</p>
                        <!-- <hr/> -->
                        @endforeach

                        @if(count($results) < 1)
                        <p>該当するものがありません</p>
                        @endif

                        @endisset
                    </div>
                    <hr/>
                    <p class="text-right"><a href="{{ route('search.index')}}">もっと(他の)表現を探す</a></p>
                </div>
                <!-- <hr/> -->
            </div>
        </div>    
    </div><!-- "row" -->

    <div class="heading mb-5">
        <h2><strong><span class="under">表現を探す</span></strong></h2>
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
    </div><!-- "row" -->

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