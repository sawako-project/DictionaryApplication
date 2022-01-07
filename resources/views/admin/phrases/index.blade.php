@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">
    <div class="row">
    
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
        @endif

        <h1 class="display-3">表現一覧</h1> 
        <div>
            <a style="margin: 15px;" href="{{ route('admin.phrase.create')}}" class="btn btn-primary">表現追加</a>
            <a style="margin: 15px;" href="{{ route('admin.phrase_category.index')}}" class="btn btn-primary">カテゴリ一覧</a>
            <!-- <a style="margin: 15px;" href="{{-- route('admin.base_category.index')--}}" class="btn btn-primary">分類一覧</a> -->
        </div> 

        <!--  table table-bordered-->
        <table class="table table-striped">
            <thead>
                <tr class="text-white bg-dark font-weight-bold">
                    <td>ID</td>
                    <td>表現</td>
                    <td>カテゴリ/タグ</td>
                    <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($phrases as $phrase)
                <tr>
                    <th>{{$phrase->id}}</th>
                    <td>{{$phrase->phrase}}</td>
                    <td>
                        @foreach($phrase->phraseCategories as $phraseCategory)
                        <a href="{{ route('admin.phrase.index', ['c' => $phraseCategory->id]) }}" class="btn btn-secondary">{{ $phraseCategory->phrase_category }}</a>
                        @endforeach
                        <hr />

                        @foreach($phrase->phraseTags as $phraseTag)
                        <a href="{{ route('admin.phrase.index', ['t' => $phraseTag->id]) }}">{{ $phraseTag->phrase_tag }}</a>
                        @endforeach
                    </td>

                    <!-- <td>
                        @//foreach($phrase->phraseTags as $phraseTag)
                        <a href="{{-- route('admin.phrase.index', ['pt' => $phraseTag->id]) --}}" class="btn btn-secondary">{{-- $phraseTag->phrase_tag --}}</a>
                        @//endforeach
                    </td> -->

                    <td>
                        <a href="{{ route('admin.phrase.edit',$phrase->id)}}" class="btn btn-primary">編集</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.phrase.destroy', $phrase->id)}}" method="post">
                        @csrf
                            <button class="btn btn-danger" type="submit">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
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

<button><a href="{{route('admin.top')}}">管理者ダッシュボード</a></button>

@endsection('content')