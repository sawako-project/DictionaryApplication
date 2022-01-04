@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

@section('header-title', 'お問い合わせ')

@section('content')
    
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif

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
                                    <form method="post" action="{{ route('about.contact.confirm') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="call_name" class="col-md-4 col-form-label text-md-right">お問い合わせ時氏名(カタカナ・フリガナ・読み方(カタカナ))</label>
                                            <div class="col-md-6">
                                                <input type="text" name="call_name" value="{{ old('call_name') }}" class="m-form-text" />
                                            </div>
                                            <small class="form-text text-muted">全角で記入してください</small>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">お問い合わせ時氏名(漢字)</label>
                                            <div class="col-md-6">
                                                <input type="text" name="name" value="{{ old('name') }}" class="m-form-text" />
                                            </div>
                                            <small class="form-text text-muted">全角で記入してください</small>
                                        </div>
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
                                            <small class="form-text text-muted">メールアドレスを記入してください</small>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('タイトル') }}</label>
                                            <div class="col-md-6">
                                                <input type="text" name="title" value="{{ old('title') }}" class="m-form-text @error('title') is-invalid @enderror" required autocomplete="title" autofocus/>
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">※なくても大丈夫です。</small>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contact_text" class="col-md-4 col-form-label text-md-right">{{ __('お問い合わせ内容') }}</label>
                                            <div class="col-md-6 textarea-space">
                                                <textarea name="contact_text" class="m-form-textarea" required>{{ old('contact_text') }}</textarea>
                                                <small class="form-text text-muted">不明点・ご要望などを記入してください</small>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('確認画面へ') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- <div class="card-body"> -->
                            </div><!-- <div class="card"> -->
                            <p>※お問い合わせは営業時間内に順次対応いたします。</p>
                            <p>土・日・祝日にいただいたメールにつきましては、翌営業日以降にご返信いたしますので あらかじめご了承ください。また、内容により回答にお日にちをいただく可能性がございます。</p>
                            <p>※下記のドメインを受信可能な設定となっているかご確認いただいた上でお問い合わせください。</p>
                            <p>@.co.jp</p>

                            <p>《お問い合わせ受付時間》</p>
                            <p>お問い合わせ受付時間：AM10:00～PM6:00(土・日・祝日を除く)</p>
                        </div><!-- <div class="col"> -->
                    </div><!-- <div class="row"> -->
</div>


@endsection('content')

