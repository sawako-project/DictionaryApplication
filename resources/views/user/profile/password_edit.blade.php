@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'パスワードの変更')

@section('content')


@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<br />
@endif

<div class="container"><!-- container-fluid -->
   <div class="row"><!-- row no-gutters -->
 
       <div class="col-sm-12">

        
        <form method="post" action="{{ url('/user/reset/password') }}">
        
            @csrf
            
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
                <div class="col-md-6 textarea-space">

                    
                    <input type="password" name="password" value="{{ old('password', $user->password) }}" class="m-form-text @error('password') is-invalid @enderror" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    

                    <small class="form-text text-muted">8文字以上</small>
                </div>
            </div>

            
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワードの再確認') }}</label>

                <div class="col-md-6 textarea-space">
                    <!-- <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> -->
                    <input id="password-confirm" type="password" class="m-form-text @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password"/>
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