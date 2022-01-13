@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'お問い合わせ内容の確認画面')

@section('content')

<style>

.contact input,textarea {
    visibility: hidden;
}

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 base-card" >
                <div class="card-header">{{ __('お問い合わせ') }}</div>
                <div class="card-body">
                    <div class="contact">
                        <form method="post" action="{{ route('about.contact.send') }}">
                        @csrf
                            <label for="name" class="col-md-4 col-form-label text-md-right">お問い合わせ時氏名(漢字)</label>
                            {{ $inputs['name'] }}
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ $inputs['name'] }}" class="m-form-text" />
                            </div>

                            <label for="call_name" class="col-md-4 col-form-label text-md-right">お問い合わせ時氏名(フリガナ)</label>
                            {{ $inputs['call_name'] }}
                            <div class="col-md-6">
                                <input type="text" name="call_name" value="{{ $inputs['call_name'] }}" class="m-form-text" />
                            </div>

                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                            {{ $inputs['email'] }}
                            <div class="col-md-6">
                                <input type="email" name="email" value="{{ $inputs['email'] }}" class="m-form-text" />
                            </div>

                            <label for="title" class="col-md-4 col-form-label text-md-right">タイトル</label>
                            {{ $inputs['title'] }}
                            <div class="col-md-6">
                                <input type="text" name="title" value="{{ $inputs['title'] }}" class="m-form-text" />    
                            </div>

                            <label for="contact_text" class="col-md-4 col-form-label text-md-right">お問い合わせ内容</label>
                            {!! nl2br(e($inputs['contact_text'])) !!}
                            <div class="col-md-6 textarea-space">
                                <textarea name="contact_text" class="m-form-textarea">{{ $inputs['contact_text'] }}</textarea>
                            </div>

                            <div class="form-group mb-1 text-center row">
                                <div class="col-md-6">
                                    <button type="submit" name="action" class="btn btn-outline-primary" value="back">
                                        {{ __('内容を修正する') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mb-1 text-center row">
                                <div class="col-md-6">
                                    <button type="submit" name="action" class="btn btn-primary" value="submit">
                                        {{ __('送信する') }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')