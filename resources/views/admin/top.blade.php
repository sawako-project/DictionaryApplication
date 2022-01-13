@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-sm-8">
			<div class="card base-card">
				<div class="card-header">管理側トップ</div>
				<div class="card-body">
					<a href="{{route('admin.phrase.index')}}" class="btn btn-primary">管理者表現一覧</a>
					<a href="{{route('admin.phrase_category.index')}}" class="btn btn-primary">管理者カテゴリ一覧</a>
					<a href="{{route('admin.event.index')}}" class="btn btn-primary">管理者イベント一覧</a>
					<form method="post" action="{{ url('admin/logout') }}">
						@csrf
						<button type="submit" class="btn btn-danger my-1">
							{{ __('ログアウト') }}
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
  
@endsection('content')