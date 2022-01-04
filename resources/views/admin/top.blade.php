<!-- @//extends('layouts.app',["title"=>"U_Dectionary"]) -->
@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

   <div class="container">
	<div class="card base-card">
		<div class="card-header">管理側TOP</div>
		<div class="card-body">
			<!-- <div>
				<a href="{{-- url('admin/user_list') --}}" class="btn btn-primary">ユーザー一覧</a>
			</div> -->
            <button><a href="{{route('admin.phrase.index')}}">管理者表現一覧</a></button>
            <button><a href="{{route('admin.phrase_category.index')}}">管理者カテゴリ一覧</a></button>
            <!-- <button><a href="{{--route('admin.base_category.index')--}}"> ｢管理者分類一覧｣</a></button> --> 
			<button><a href="{{route('admin.event.index')}}">管理者イベント一覧</a></button>

			<form method="post" action="{{ url('admin/logout') }}">
				@csrf
				<input type="submit" class="btn btn-danger" value="ログアウト" />
			</form>
		</div>
	</div>
</div>
  
@endsection('content')
