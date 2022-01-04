@extends('layouts.dictionary',["title"=>"U_Dectionary"])

{{--@section('header-title', '表現確認(詳細)')--}}

@section('content')


{{ Breadcrumbs::render('phrase.show', $phrase) }}

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <!--  -->
            <div class="card base-card">
                <div class="card-header">表現確認(詳細)</div>
                <div class="card-body">
                    <!--  -->
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">ID： {{$phrase->id}}</li>  
                        <li class="list-group-item">表現： {{$phrase-> phrase}}</li>
                        <li class="list-group-item">カテゴリ： 
                        @foreach($phrase->phraseCategories as $phraseCategory) 
                            <a href="{{ route('phrase.category', ['category' => $phraseCategory->phrase_category]) }}" class="btn btn-secondary">{{ $phraseCategory->phrase_category }}</a>
                        @endforeach
                        </li>

                        <li class="list-group-item">タグ： 
                        @foreach($phrase->phraseTags as $phraseTag)
                            <a href="{{ route('phrase.tag', ['tag' => $phraseTag->phrase_tag]) }}" class="btn btn-outline-secondary">{{ $phraseTag->phrase_tag }}</a>
                        @endforeach
                        </li>

                        @if($phrase->user_id)
                        <li class="list-group-item">
                            Create by {{ ($phrase->user) ? $phrase->user->name : "-"}}{{-- $phrase->user->name --}}

                            @auth
                            @if($phrase->user_id == Auth::id())
                            <a href="{{ route('user.phrase.edit',$phrase->id)}}" class="btn btn-primary">編集</a>
                            @endif
                            @endauth

                        </li>
                        @endif
                    </ul>
                    <!--  -->

                    @guest
                    <div class="like-function">
                        {{--@if(isset($likes[$phrase->id]) && $likes[$phrase->id])--}}<!--$likes[$like->phrase_id]-->
                        @if($like && $like->liked == 1)
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                            <i class="bi bi-bookmark-fill"></i>
                        </a>
                        @else
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                            <i class="bi bi-bookmark"></i>
                        </a>
                        @endif
                    </div><!--like-function -->
                    @endguest

                    @auth

                    @if($phrase->user_id !== Auth::id())
                    <div class="like-function">
                        
                        {{--@if(isset($likes[$phrase->id]) && $likes[$phrase->id])--}}<!--$likes[$like->phrase_id]-->
                        @if($like && $like->liked == 1)
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                            <i class="bi bi-bookmark-fill"></i>
                        </a>
                        @else
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                            <i class="bi bi-bookmark"></i>
                        </a>
                        @endif
                    </div><!--like-function -->
                    @endif

                    @endauth

                </div><!-- card-body -->
            </div><!--card-->

        <!--  -->
        <!-- <ul class="list-group list-group-flush">
            <li class="list-group-item">ID： {{--$phrase->id--}}</li>
            <li class="list-group-item">表現： {{--$phrase-> phrase--}}</li>

            {{--@foreach($phrase->phraseCategories as $phraseCategory)--}}
            <li class="list-group-item">カテゴリ： <a href="">{{-- $phraseCategory->phrase_category --}}</a></li>
            {{--@endforeach--}}

            <li class="list-group-item">タグ： 
            {{--@foreach($phrase->phraseTags as $phraseTag)--}}
            {{-- $phraseTag->phrase_tag --}}<span>,</span>
            {{--@endforeach--}}
            </li>

            {{--@if($phrase->user_id)--}}
            <li class="list-group-item">
                Create by {{-- $phrase->user->name --}}

                <a href="{{-- route('user.phrase.edit',$phrase->id)--}}" class="btn btn-primary">編集</a>
            </li>
            {{--@endif--}}
        </ul> -->
        <!--  -->


        </div><!-- col -->
    </div><!-- row -->

    <hr>
    <a href="{{ route('phrase.index')}}">戻る</a>
    @auth
    <!-- <a href="{{-- route('user.user_bookmark_list')--}}">ブックマーク一覧に戻る</a> -->
    <!-- <a href="{{-- route('user.phrase.index')--}}">自分の表現に戻る</a> -->
    @endauth

</div><!-- container -->

@endsection('content')
