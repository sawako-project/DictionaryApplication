@extends('layouts.dictionary',["title"=>"U_Dectionary"])

@section('header-title', '自分の表現')

@section('content')
<div class="container">
    <div class="row py-3">
      
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
  </div>

<!--  -->
<div class="phrase_create" id="phrase_create">
        <a href="{{ route('user.phrase.create') }}"><i class="bi bi-plus-square fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="追加する"></i></a>
    <!-- <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}{{-- route('user.base_category.index')--}}" class="btn btn-primary">表現追加・分類一覧</a> -->
  </div>
<!--  -->

    <div class="phrase_create" id="phrase_create">
        <a href="{{ route('user.phrase.create') }}"><i class="bi bi-plus-square fa-pull-right fa-2x" data-bs-toggle="tooltip" data-bs-placement="top" title="追加する"></i></a>
    <!-- <a style="margin: 15px;" href="{{-- route('user.phrase.create') --}}{{-- route('user.base_category.index')--}}" class="btn btn-primary">表現追加・分類一覧</a> -->
  </div>

    @if(count($phrases) < 1)
    <p>自分の表現がありません</p>
    @endif

<!-- phrase-list res-->
<div class="row">
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
                <!--  -->
                @guest
                <div class="like-function">
                    <!--$likes[$like->phrase_id]-->
                    @if(isset($likes[$phrase->id]) && $likes[$phrase->id])
                    {{--@if($like && $like->liked == 1)--}}
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
                <!--  -->
                @auth

                @if($phrase->user_id !== Auth::id())
                <div class="like-function">
                    <!--$likes[$like->phrase_id]-->
                    @if(isset($likes[$phrase->id]) && $likes[$phrase->id])
                    {{--@if($like && $like->liked == 1)--}}
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
                <!--  -->
            </div>
        </div>
    @endforeach
    </div>
</div>
<!-- phrase-list res-->

 

</div>

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



@endsection('content')
