@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])
 
@section('header-title', 'メールアドレスの変更')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="{{ url('/user/reset/email') }}">
            @csrf
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                    <div class="col-md-6 textarea-space">  
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="m-form-text @error('email') is-invalid @enderror" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small class="form-text text-muted">半角英数字を使用してください。</small>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('変更') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')