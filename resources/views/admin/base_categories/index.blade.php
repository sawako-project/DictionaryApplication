<!-- @//extends('layouts.app',["title"=>"U_Dectionary"]) -->
@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')



<div class="container">
    <div class="row">
      
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif

  <h1 class="display-3">表現の分類一覧</h1> 
  <div>
 <a style="margin: 15px;" href="{{ route('admin.base_category.create')}}" class="btn btn-primary">分類追加</a>
 <a style="margin: 15px;" href="{{ route('admin.phrase.index')}}" class="btn btn-primary">表現一覧</a>
 <a style="margin: 15px;" href="{{ route('admin.phrase_category.index')}}" class="btn btn-primary">カテゴリ一覧</a>
</div> 

<table class="table table-bordered">
@foreach($base_categories as $base_category)
<tr>
  <th>{{$base_category->id}}</th>
  <td>{{$base_category->base_category}}</td>
  <td>
    <a href="{{ route('admin.base_category.edit',$base_category->id)}}" class="btn btn-primary">編集</a>
            
    <form action="{{ route('admin.base_category.destroy', $base_category->id)}}" method="post">
      @csrf
      <button class="btn btn-danger" type="submit">削除</button>
    </form>

  </td>
</tr>
@endforeach
</table>

 <button><a href="{{route('admin.top')}}">管理者ダッシュボード</a></button>

@endsection('content')
