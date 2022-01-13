@extends('layouts.dictionary',["title"=>"U_Dectionary"])

{{--@section('header-title', '表現確認(詳細)')--}}

@section('content')

{{ Breadcrumbs::render('phrase.show', $phrase) }}

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card base-card">
                <div class="card-header">表現確認(詳細)</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">表現: {{$phrase-> phrase}}</li>
                        <li class="list-group-item">カテゴリ: 
                        @foreach($phrase->phraseCategories as $phraseCategory) 
                            <a href="{{ route('phrase.category', ['category' => $phraseCategory->phrase_category]) }}" class="btn btn-secondary">{{ $phraseCategory->phrase_category }}</a>
                        @endforeach
                        </li>
                        <li class="list-group-item">タグ: 
                        @foreach($phrase->phraseTags as $phraseTag)
                            <a href="{{ route('phrase.tag', ['tag' => $phraseTag->phrase_tag]) }}" class="btn btn-outline-secondary">{{ $phraseTag->phrase_tag }}</a>
                        @endforeach
                        </li>
                        
                        @if($phrase->user_id)
                        <li class="list-group-item">
                            作成ユーザー: {{ ($phrase->user) ? $phrase->user->name : "-"}}
                        </li>
                    </ul>

                    @auth
                    @if($phrase->user_id == Auth::id())
                    <hr/>
                    <button class="btn btn-primary text-nowrap mb-1"><a href="{{ route('user.phrase.edit',$phrase->id)}}"class="text-white" >編集</a></button>
                    <form action="{{ route('user.phrase.destroy', $phrase->id)}}" method="post">
                    @csrf
                        <button class="btn btn-danger text-nowrap mb-1" type="submit" onclick="return confirm('削除しますか?');">削除</button>
                    </form>
                    @endif
                    @endauth

                    @endif

                    @guest
                    <div class="like-function">
                        {{--@if(isset($likes[$phrase->id]) && $likes[$phrase->id])--}}<!--$likes[$like->phrase_id]-->
                        @if($like && $like->liked == 1)
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}" class="btn btn-light">
                            <i class="bi bi-bookmark-fill"></i>
                        </a>
                        @else
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}" class="btn btn-light">
                            <i class="bi bi-bookmark"></i>
                        </a>
                        @endif
                    </div>
                    @endguest

                    @auth
                    @if($phrase->user_id !== Auth::id())
                    <div class="like-function">  
                        {{--@if(isset($likes[$phrase->id]) && $likes[$phrase->id])--}}<!--$likes[$like->phrase_id]-->
                        @if($like && $like->liked == 1)
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}" class="btn btn-light">
                            <i class="bi bi-bookmark-fill"></i>
                        </a>
                        @else
                        <a href="{{ url('/user/phrase/like/'.$phrase->id) }}" class="btn btn-light">
                            <i class="bi bi-bookmark"></i>
                        </a>
                        @endif
                    </div>
                    @endif
                    @endauth
                </div>
            </div>

        </div>
    </div>
</div>

<hr/>
<a class="btn btn-outline-primary" href="{{ url('/phrase') }}">表現一覧</a>
<a class="btn btn-outline-primary" href="{{ url('/') }}">トップ</a>
        
@endsection('content')