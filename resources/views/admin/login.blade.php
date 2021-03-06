@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-my-8">
			<div class="card base-card">
				<div class="card-header">ログイン</div>
				<div class="card-body">
					<form method="post" action="{{ url('admin/login') }}">
					@csrf 
						<div>
							ID: <input class="form-control" type="text" name="user_id" value="" />
						</div>
						<div>
							PASS: <input class="form-control" type="password" name="password" value="" />
						</div>
						<div class="mt-3">
							<input class="btn btn-primary" type="submit" value="ログイン" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')