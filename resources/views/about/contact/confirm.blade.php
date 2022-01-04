@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'お問い合わせ内容の確認画面')

@section('content')
    
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif
<style>
.contact input,textarea{
    visibility: hidden;
}
</style>

<div class="container"><!-- container-fluid -->
<div class="row" ><!--justify-content-center"  -->
                        <div class="col-md-12">
                            <div class="card mb-3 base-card" >
                                <div class="card-header">{{ __('お問い合わせ') }}</div>
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
                                <div class="contact">

                                    <form method="post" action="{{ route('about.contact.send') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="call_name" class="col-md-4 col-form-label text-md-right">お問い合わせ時氏名(カタカナ・フリガナ・読み方(カタカナ))</label>
                                            {{ $inputs['call_name'] }}
                                            <div class="col-md-6">
                                                <input type="text" name="call_name" value="{{ $inputs['call_name'] }}" class="m-form-text" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">お問い合わせ時氏名(漢字)</label>
                                            {{ $inputs['name'] }}
                                            <div class="col-md-6">
                                                <input type="text" name="name" value="{{ $inputs['name'] }}" class="m-form-text" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                                            {{ $inputs['email'] }}
                                            <div class="col-md-6">
                                                <input type="email" name="email" value="{{ $inputs['email'] }}" class="m-form-text" />
                                            </div>
            
                                        </div>

                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('タイトル') }}</label>
                                            {{ $inputs['title'] }}
                                            <div class="col-md-6">
                                                <input type="text" name="title" value="{{ $inputs['title'] }}" class="m-form-text" />    
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="contact_text" class="col-md-4 col-form-label text-md-right">{{ __('お問い合わせ内容') }}</label>
                                            {!! nl2br(e($inputs['contact_text'])) !!}
                                            <div class="col-md-6 textarea-space">
                                                <textarea name="contact_text" class="m-form-textarea">{{ $inputs['contact_text'] }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" name="action" class="btn btn-primary" value="back"><!-- class="btn btn-primary"class="btn btn-success"-->
                                                    {{ __('内容を修正する') }}
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" name="action" class="btn btn-primary" value="submit"><!-- class="btn btn-primary"class="btn btn-success"-->
                                                    {{ __('送信する') }}
                                                </button>
                                            </div>
                                        </div>


                                    </form>
                                    </div>

                                </div><!-- <div class="card-body"> -->
                            </div><!-- <div class="card"> -->
                        </div><!-- <div class="col"> -->
                    </div><!-- <div class="row"> -->
</div>

@endsection('content')

