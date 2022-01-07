@extends('layouts.dictionary',["title"=>"U_Dectionary"])
 
@section('content')
 
<div class="heading">
   <h2><strong><span class="under">会員登録</span></strong></h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">{{ __('会員登録') }}</div>
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
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('お名前') }}</label>
                            <div class="col-md-6">
                                <!-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{-- old('name') --}}" required autocomplete="name" autofocus> -->
                                <input id="name" type="text" class="m-form-text @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{-- old('email') ---}}" required autocomplete="email"> -->
                                <input id="email" type="email" class="m-form-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>
                            <div class="col-md-6">
                                <!-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> -->
                                <input id="password" type="password" class="m-form-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワードの再確認') }}</label>
                            <div class="col-md-6">
                                <!-- <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> -->
                                <input id="password-confirm" type="password" class="m-form-text" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4"><!-- <div class="col-md-8 offset-md-4"> -->
                                <button type="submit" class="btn btn-primary"><!-- class="btn btn-primary"class="btn btn-success"-->
                                    {{ __('会員登録') }}
                                </button>
                            </div>
                        </div>
                        <a href="{{ url('/login') }}">既に登録している方はこちら</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')