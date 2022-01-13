@extends('layouts.dictionary',["title"=>"U_Dectionary"])
 
@section('content')
 
<div class="heading">
   <h2><strong><span class="under">ログイン</span></strong></h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">{{ __('ログイン') }}</div>
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
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="m-form-text @error('email') is-invalid @enderror" required autocomplete="email" autofocus/>
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

                            <!-- パスワード目隠し -->
                                <div id="fieldPassword" class="d-flex">
                                    <input id="password" type="password" class="m-form-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                    <button type="button" class="btn btn-link text-dark"><span id="buttonEye" class="bi bi-eye-fill"></span></button>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 check-list">
                                <label for="remember">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                    <span class="m-form-checkbox-name" for="remember">
                                        <span class="m-form-checkbox-text" for="remember">{{ __('記憶させる') }}</span>
                                    </span>
                                </label>    
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
                <p><a href="{{ url('/register') }}">まだ登録していない方はこちら</a></p>
            </div>
        </div>
    </div>
</div>

<script>

$(function(){

    $("#buttonEye").on("click", function(){

        if($("#password").attr("type") == "password"){
        $("#password").attr("type","text");
        $("#buttonEye").attr("class","bi bi-eye-slash-fill");
        }else{
        $("#password").attr("type","password");
        $("#buttonEye").attr("class","bi bi-eye-fill");
        }

    });
});

</script>

@endsection('content')