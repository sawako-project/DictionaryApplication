<!-- @//extends('layouts.app',["title"=>"U_Dectionary"]) -->
@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')


<div class="container">
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">表現確認</h1>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">ID： {{$phrase->id}}</li>
            <li class="list-group-item">表現： {{$phrase-> phrase}}</li>
            <li class="list-group-item">カテゴリ： {{$phrase-> phrase_category_id}}</li>
            <li class="list-group-item">サブカテゴリ： {{$phrase-> phrase_tag_id}}</li>
        </ul>
    </div>
</div>
<hr>
<a href="{{ route('phrases.index')}}">戻る</a>
<a href="{{route('admin.phrase.index')}}">管理者表現一覧</a>

</div>

@endsection('content')