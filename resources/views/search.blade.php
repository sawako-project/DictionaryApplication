@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => true])

@section('header-title', '表現を探す')

@section('content')
<div class="container">
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
                    <div class="item_box">
                        <p class="card-text">{{ $phrase->updated_at }}</p>
                        <p class="card-text">{{ $phrase->phrase }}</p>
                        @foreach($phrase->phraseCategories as $phraseCategory)
                        <!-- <p class="card-text"><a href="{{-- route('phrase.category', ['category' => $phraseCategory->phrase_category]) --}}" class="btn btn-secondary">{{-- $phraseCategory->phrase_category --}}</a></p> -->
                        <p class="card-text">{{ $phraseCategory->phrase_category }}</p>
                        <p class="card-text">by:{{ ($phrase->user) ? $phrase->user->name : "-"}}<i class="bi bi-person-fill"></i></p>{{-- $phrase->user->name --}}    
                        @endforeach
                    </div>
                    <hr/>
                @endforeach
                @endif
                    <hr/>
                    <p class="text-right"><a href="{{ url('/phrase') }}">表現一覧(掲示板)を開く(もっと見る)<span><i class="bi bi-arrow-right-short"></i></span></a></p>
                </div>
            </div> 
        </div><!-- //.col-8 -->
    </div><!-- "row" -->

    <div class="row">
        <div class="col-sm-12">
            <div class="heading mb-5">
                <h2><strong><span class="under">カテゴリごとの表現</span></strong></h2><!-- カテゴリから探す -->
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
                <!-- {{--@//foreach($phraseCategories_feelings as $phraseCategories_feeling)plunk
                    <span><a href="{{-- url('/search_phrases') --}}">{{-- $phraseCategories_feeling --}}</a></span>
                @//endforeach --}} -->
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
                <!-- {{--@//foreach($phraseCategories_actions as $phraseCategories_action)
                    <span><a href="{{-- url('/search_phrases') --}}">{{-- $phraseCategories_action --}}</a></span>
                @//endforeach--}} -->
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
                <!-- {{--@//foreach($phraseCategories_expressions as $phraseCategories_expression)
                    <span><a href="{{-- url('/search_phrases') --}}">{{-- $phraseCategories_expression --}}</a></span>
                @//endforeach--}} -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')