@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.phrase.index') }}

    <div class="row">
        <div class="col-sm-12">

            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}  
            </div>
            @endif

            <h1 class="display-3">表現一覧</h1> 
            <div>
                <a style="margin: 15px;" href="{{ route('admin.phrase.create')}}" class="btn btn-primary">表現追加</a>
            </div> 

            <table class="table table-striped">
                <thead>
                    <tr class="text-white bg-dark font-weight-bold">
                        <td>ID</td>
                        <td>表現</td>
                        <td>カテゴリ/タグ</td>
                        <td><i class="bi bi-person-fill"></i>作成ユーザー</td>
                        <td colspan = 2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($phrases as $phrase)
                    <tr>
                        <th>{{$phrase->id}}</th>
                        <td><strong><a href="{{ route('admin.phrase.show', $phrase->id)}}">{{ mb_strimwidth($phrase->phrase, 0, 13, "...") }}</a></strong></td>
                        <td>
                            @foreach($phrase->phraseCategories as $phraseCategory)
                            <a href="{{ route('admin.phrase.index', ['c' => $phraseCategory->id]) }}" class="btn btn-outline-primary ">{{ $phraseCategory->phrase_category }}</a>
                            @endforeach
                            <hr />
                            @foreach($phrase->phraseTags as $phraseTag)
                            <a href="{{ route('admin.phrase.index', ['t' => $phraseTag->id]) }}" class="btn btn-outline-secondary">{{ $phraseTag->phrase_tag }}</a>
                            @endforeach
                        </td>
                        <td>{{ ($phrase->user) ? $phrase->user->name : "-"}}</td>
                        @if(!$phrase->user_id)
                        <td>
                            <a href="{{ route('admin.phrase.edit',$phrase->id)}}" class="btn btn-primary">編集</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.phrase.destroy', $phrase->id)}}" method="post">
                            @csrf
                                <button class="btn btn-danger" type="submit">削除</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
    </div> 
</div>

<div class='pagination justify-content-center'>
@component('parts.components.item_pager')
    @slot("item_list",$phrases)
@endcomponent
</div>

<hr/>
<a href="{{ route('admin.top')}}" class="btn btn-outline-primary mx-1">管理者トップ</a>
<a href="{{ route('admin.phrase.index') }}" class="btn btn-outline-primary mx-1">管理者表現一覧</a>

@endsection('content')