@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

{{--@section('header-title', 'お問い合わせ')--}}

@section('content')
    
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif

<h1 class="text-center" style="font-family: 'Kiwi Maru', serif;">{{ __('送信完了') }}</h1>

<p class="text-center" style="font-family: 'Kiwi Maru', serif;"><a href="{{ url('/') }}">{{ __('トップに戻る') }}</a></p>

@endsection('content')