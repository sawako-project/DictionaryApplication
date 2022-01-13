@extends('layouts.dictionary',["title"=>"U_Dectionary"])

@section('header-title', '表現一覧')

@section('content')

@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}  
</div>
@endif

<div class="container">
    <div class="row">

        @auth
        <div class="phrase_create" id="phrase_create">
            <!-- <a href="{{-- route('user.phrase.create') --}}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="表現を作成する"></i></a> -->
            <a href="{{ route('user.phrase.create') }}" class="btn btn-outline-primary text-nowrap mb-3">表現を作成する</a>
            <!-- <div>
                <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}" class="btn btn-primary">表現追加</a>
            </div> -->
        </div>
        <hr/>
        @endauth

        <div class="mx-2 my-2">
        <a class="btn btn-outline-primary" href="{{ url('/phrase') }}">表現一覧</a>
        <a class="btn btn-outline-primary" href="{{ url('/') }}">トップ</a>
        </div>

        @if(isset($tag))
        <p style="font-family: 'Kiwi Maru', serif;">タグ: <span class="btn btn-outline-secondary"> {{ $tag->phrase_tag }}</span></p>  

        @elseif(isset($category))
        <p style="font-family: 'Kiwi Maru', serif;">カテゴリ: <span class="btn btn-secondary"> {{ $category->phrase_category }}</span></p>

        @else

        @endif

        @if(count($phrases) < 1)
        <p>みんなの表現がありません</p>
        @endif

        <div class="col-sm-12">
        @foreach($phrases as $phrase)
            <div class="card mb-5 pop-card">
                <div class="card-header">{{ $phrase->phrase }}</div>
                <div class="card-body">

                @include("parts.phrase.phrase_info", ["phrase" => $phrase])

                    @guest
                    <div class="like-function">
                        <!--$likes[$like->phrase_id]-->
                        @if(isset($likes[$phrase->id]) && $likes[$phrase->id])
                        {{--@if($like && $like->liked == 1)--}}
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
                        <!--$likes[$like->phrase_id]-->
                        @if(isset($likes[$phrase->id]) && $likes[$phrase->id])
                        {{--@if($like && $like->liked == 1)--}}
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
        @endforeach
        </div>
    </div>

    <div class='d-flex pagination justify-content-center'>

    {{ $phrases->links() }}

        <style type="text/css">

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
    </div>
    <hr>
    <a class="btn btn-outline-primary" href="{{ url('/phrase') }}">表現一覧</a>

</div>

@endsection('content')   