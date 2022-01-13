@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.phrase.show',$phrase) }}

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <!--  -->
            <!-- <h1 class="display-3">表現確認</h1>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID: {{--$phrase->id--}}</li>
                <li class="list-group-item">表現: {{--$phrase-> phrase--}}</li>
                <li class="list-group-item">カテゴリ: {{--$phrase-> phrase_category_id--}}</li>
                <li class="list-group-item">サブカテゴリ: {{--$phrase-> phrase_tag_id--}}</li>
            </ul> -->
            <!--  -->

            <!--  -->
            <h1 class="display-3">表現詳細</h1>
            <div class="card base-card">
                <div class="card-header">表現詳細</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item">イベントタイプ: {{-- $event->event_type --}}</li> -->
                        <li class="list-group-item">表現ID: <strong>{{ $phrase->id }}</strong></li>
                        <li class="list-group-item">表現: <strong>{{ $phrase->phrase }}</strong></li>
                        <li class="list-group-item">カテゴリ: 
                        @foreach($phrase->phraseCategories as $phraseCategory)
                            <a href="{{ route('admin.phrase.index', ['c' => $phraseCategory->id]) }}" class="btn btn-outline-primary ">{{ $phraseCategory->phrase_category }}</a>
                        @endforeach
                        </li>
                        <li class="list-group-item">タグ: 
                        @foreach($phrase->phraseTags as $phraseTag)
                            <a href="{{ route('admin.phrase.index', ['t' => $phraseTag->id]) }}" class="btn btn-outline-secondary">{{ $phraseTag->phrase_tag }}</a>
                        @endforeach
                        </li>
                        <li class="list-group-item">作成ユーザー: {{ ($phrase->user) ? $phrase->user->name : "-"}}<i class="bi bi-person-fill"></i></li>
                    </ul>
                    
                    @if(!$phrase->user_id)
                    <hr/>
                    <a href="{{ route('admin.phrase.edit',$phrase->id)}}" class="btn btn-primary my-1">編集</a>
                    <form action="{{ route('admin.phrase.destroy', $phrase->id)}}" method="post">
                    @csrf
                        <button class="btn btn-danger my-1" type="submit">削除</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<hr/>
<a href="{{ route('admin.top')}}" class="btn btn-outline-primary mx-1">管理者トップ</a>
<a href="{{ route('admin.phrase.index') }}" class="btn btn-outline-primary mx-1">管理者表現一覧</a>

@endsection('content')