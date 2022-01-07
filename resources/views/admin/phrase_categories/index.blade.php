@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">
    <div class="row">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div>
        @endif
        <h1 class="display-3">表現のカテゴリ一覧</h1> 
        <div>
            <a style="margin: 15px;" href="{{ route('admin.phrase_category.create')}}" class="btn btn-primary">カテゴリ追加</a>
            <a style="margin: 15px;" href="{{ route('admin.phrase.index')}}" class="btn btn-primary">表現一覧</a>
            <!-- <a style="margin: 15px;" href="{{-- route('admin.base_category.index')--}}" class="btn btn-primary">分類一覧</a> -->
        </div>
        <!--  table table-bordered-->
        <table class="table table-striped">
            <thead>
                <tr class="text-white bg-dark font-weight-bold">
                    <td>ID</td>
                    <td>カテゴリ</td>
                    <td >親玉カテゴリ</td>
                    <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($phraseCategories as $phraseCategory)
                <tr>
                    <th>{{$phraseCategory->id}}</th>
                    <td>{{$phraseCategory->phrase_category}}</td>
                    <td>
                        @foreach($phraseCategory->baseCategories as $baseCategory)
                        <a href="{{ route('admin.phrase_category.index', ['bc' => $baseCategory->code]) }}" class="btn btn-secondary">{{ $baseCategoryLabels[$baseCategory->code] }}</a>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.phrase_category.edit',$phraseCategory->id)}}" class="btn btn-primary">編集</a>
                    </td>         
                    <td>
                        <form action="{{ route('admin.phrase_category.destroy', $phraseCategory->id)}}" method="post">
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

{{ $phraseCategories->links() }}

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