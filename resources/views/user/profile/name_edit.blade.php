@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])
 
@section('header-title', 'ログインネームの変更')

@section('content')
<div class="container"><!-- container-fluid -->
   <div class="row"><!-- row no-gutters -->
 
       <div class="col-sm-12">


        <form method="post" action="{{ url('/user/reset/name') }}">
        
        @csrf
            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">ログインネーム</label>
                <div class="col-md-6 textarea-space">

              
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="m-form-text @error('name') is-invalid @enderror" />
              @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
              

                    <small class="form-text text-muted">#,$,%,*,@などの記号を含まないでください。</small>
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