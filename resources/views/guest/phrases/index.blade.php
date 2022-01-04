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

              <!--  -->
              <div class="phrase_create" id="phrase_create">
                <a href="{{ route('user.phrase.create') }}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="表現追加"></i></a>
            
                <!-- <div>
                    <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}" class="btn btn-primary">表現追加</a>
                </div> -->
            </div>
            <!--  -->
            @if(isset($tag))
            
            <p style="font-family: 'Kiwi Maru', serif;">タグ: <span class="btn btn-outline-secondary"> {{ $tag->phrase_tag }}</span></p>

            <!--  -->
            <!-- <div class="phrase_create" id="phrase_create">
                <a href="{{-- route('user.phrase.create') --}}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="表現追加"></i></a> -->
            
                <!-- <div>
                    <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}" class="btn btn-primary">表現追加</a>
                </div> -->
            <!-- </div> -->
            <!--  -->

            @elseif(isset($category))
            <p style="font-family: 'Kiwi Maru', serif;">カテゴリ: <span class="btn btn-secondary"> {{ $category->phrase_category }}</span></p>

            <!--  -->
            <!-- <div class="phrase_create" id="phrase_create">
                <a href="{{-- route('user.phrase.create',['category_id[]' => $category->id]) --}}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="表現追加"></i></a> -->
          
               <!-- <div>
                <a style="margin: 15px;" href="{{-- route('user.phrase.create',['category_id[]' => $category->id]) --}}" class="btn btn-primary">表現追加</a>
            </div> -->
            <!-- </div> -->
            <!--  -->

            @else

            <!-- <div class="phrase_create" id="phrase_create">
                <a href="{{-- route('user.phrase.create') --}}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="表現追加"></i></a> -->
           
                <!-- <div>
                    <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}" class="btn btn-primary">表現追加</a>
                </div> -->
            <!-- </div> -->


            @endif

            @endauth

            @if(count($phrases) < 1)
            <p>みんなの表現がありません</p>
            @endif

<!-- phrase-list res-->
<!-- <div class="row"> -->
    <div class="col-sm-12">
    @foreach($phrases as $phrase)
        <div class="card mb-5 pop-card">
            <div class="card-header">{{ $phrase->phrase }}</div>
            <div class="card-body">
                <div class="phrase-list">
                    <dl>
                        <dt>表現ID</dt>
                        <dd>{{ $phrase->id }}</dd>
                        <dt>表現</dt>
                        <dd><a href="{{ route('phrase.show', ['id' => $phrase->id]) }} ">{{ $phrase->phrase }}</a></dd>
                        <dt>カテゴリ</dt>
                        <dd>
                        @foreach($phrase->phraseCategories as $phraseCategory)
                        <a href="{{ route('phrase.category', ['category' => $phraseCategory->phrase_category]) }}" class="btn btn-secondary text-nowrap">{{ $phraseCategory->phrase_category }}</a>
                        @endforeach
                        </dd>
                        <dt>タグ</dt>
                        <dd>
                        @foreach($phrase->phraseTags as $phraseTag)
                        <a href="{{ route('phrase.tag', ['tag' => $phraseTag->phrase_tag]) }}" class="btn btn-outline-secondary text-nowrap">{{ $phraseTag->phrase_tag }}</a>
                        @endforeach
                        </dd>
                        <!-- <dt>営業時間</dt>
                        <dd>9：00～18：00</dd> -->

                        @if($phrase->user_id)
                        <dt>Create by</dt>
                        <dd>{{ ($phrase->user) ? $phrase->user->name : "-"}}{{-- $phrase->user->name --}}</dd>

                        @auth
                        @if($phrase->user_id == Auth::id())
                        <dt>この表現を</dt>
                        <dd style="float:left;">
                            <a href="{{ route('user.phrase.edit',$phrase->id)}}" class="btn btn-primary text-nowrap">編集</a>
                        
                            <form action="{{ route('user.phrase.destroy', $phrase->id)}}" method="post">
                        @csrf
                        <button class="btn btn-danger text-nowrap" type="submit" onclick="return confirm('削除しますか?');">削除</button>
                        </form>
                        </dd>
                        @endif
                        @endauth

                        @endif

                    </dl>
                </div>
                
                @guest
                <div class="like-function">
                    @if(isset($likes[$phrase->id]) && $likes[$phrase->id])<!--$likes[$like->phrase_id]-->
                    {{--@if($like && $like->liked == 1)--}}
                    <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                        <i class="bi bi-bookmark-fill"></i>
                    </a>
                    @else
                    <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                        <i class="bi bi-bookmark"></i>
                    </a>
                    @endif
                </div><!-- //like-function -->
                @endguest
               
                @auth

                @if($phrase->user_id !== Auth::id())
                <div class="like-function">
                    @if(isset($likes[$phrase->id]) && $likes[$phrase->id])<!--$likes[$like->phrase_id]-->
                    {{--@if($like && $like->liked == 1)--}}
                    <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                        <i class="bi bi-bookmark-fill"></i>
                    </a>
                    @else
                    <a href="{{ url('/user/phrase/like/'.$phrase->id) }}">
                        <i class="bi bi-bookmark"></i>
                    </a>
                    @endif
                </div><!--- //like-function -->
                @endif

                @endauth
               
            </div>
        </div>
    @endforeach
    </div>
</div>
<!-- phrase-list res-->


<div class='pagination justify-content-center'>
{{ $phrases->links() }}

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

<hr>
<a href="{{ url('dictionary_top.index')}}">戻る</a><!-- /home -->

</div><!-- container -->

@endsection('content')

        