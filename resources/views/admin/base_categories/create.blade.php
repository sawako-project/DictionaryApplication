<!-- @//extends('layouts.app',["title"=>"U_Dectionary"]) -->
@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">{{ __('BaseCategory') }}</div>
                    <div class="card-body">
                @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
     </div><br />
    @endif
    <form method="post" action="{{ route('admin.base_category.store') }}">
          @csrf

        <div class="form-group row">
            <label for="base_category" class="col-md-4 col-form-label text-md-right">{{ __('BaseCategory') }}</label>

            <div class="col-md-6">
                <input id="" type="text" class="form-control" name="base_category" value="{{ old('base_category') }}" required autocomplete="" autofocus />
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('登録') }}
                </button>
            </div>
        </div>

</form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection('content')