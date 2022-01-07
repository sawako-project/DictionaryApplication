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
                            <!-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> -->
                                <!-- <input id="password" type="password" class="m-form-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/> --><!-- autofocus -->
                            
                            <!-- 目のやつ -->
                                <div id="fieldPassword" class="d-flex">
                                    <input id="password" type="password" class="m-form-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                    <button type="button" class="btn btn-link text-dark"><span id="buttonEye" class="bi bi-eye-fill"></span></button><!-- fa fa-eye -->
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{-- old('remember') ? 'checked' : '' --}}>

                                    <label class="form-check-label" for="remember">
                                        {{-- __('Remember Me') --}}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <div class="col-md-6 check-list">
                                <label for="remember">
                                <!-- <div class="col-md-6 offset-md-4">
                                    <div class="form-check">-->
                                <!--  <label for="remember"> -->
                                <!-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{-- old('remember') ? 'checked' : '' --}}/> -->
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                    <span class="m-form-checkbox-name" for="remember">
                                        <span class="m-form-checkbox-text" for="remember">{{ __('記憶させる') }}</span>
                                    </span>
                                    <!-- </label>  -->
                                        <!--</div>
                                </div> -->
                                </label>    
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4"><!-- <div class="col-md-8 offset-md-4"> -->
                                <button type="submit" class="btn btn-primary"><!-- class="btn btn-primary"class="btn btn-success"-->
                                    {{ __('ログイン') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <p><a href="{{ url('/register') }}">まだ登録していない方はこちら</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <p class="caption">文章が続く中で<span class="cap" data-tippy-content="キャプションが入ります。">この文章にカーソルを合わせると</span>ツールチップが出ます</p>

<button class="btn cap" data-tippy-content="<div class='inner-cap'><p>続きは会員登録をしたら読むことができます。</p><p>ツールチップにはHTMLも使えます。</p></div>">ボタン</button> -->

<script>

$(function(){

    $("#buttonEye").on("click", function(){

        if($("#password").attr("type") == "password"){
        $("#password").attr("type","text");
        $("#buttonEye").attr("class","bi bi-eye-slash-fill");//<i class="bi bi-eye-slash-fill"></i>//fa fa-eye-slash
        }else{
        $("#password").attr("type","password");
        $("#buttonEye").attr("class","bi bi-eye-fill");//<i class="bi bi-eye-fill"></i>//fa fa-eye
        }

    });
});

// $(function(){
//     tippy('.cap', {//指定した要素にツールチップが出現
//   placement: 'top-start',//ツールチップの表示位置⇒top、top-start、top-end、right、right-start、right-end、bottom、bottom-start、bottom-end、left、left-start、left-end。指定をしなくてもtopに表示
//   animation: 'shift-toward-subtle',//ツールチップ出現の動き。動きを指定するにはhttps://unpkg.com/browse/tippy.js@5.0.3/animations/から任意の動きを選び<head>内に読み込むことが必要。使用できる動き⇒shift-away、shift-away-subtle、shift-away-extreme、shift-toward、shift-toward-subtle、shift-toward-extreme、scale、scale-subtle、scale-extreme、perspective、perspective-subtle、perspective-extreme。指定をしなくてもfadeで表示
//   theme: 'light-border',//ツールチップのテーマの色。色を指定するにはhttps://unpkg.com/browse/tippy.js@5.0.3/themes/からテーマを選び<head>内に読み込んで指定する。テーマの種類⇒light、light-border、material、translucent。指定をしなくても黒色で表示
//   duration: 200,//ツールチップの出現の速さをミリ秒単位で指定
// })
//});

</script>

@endsection('content')