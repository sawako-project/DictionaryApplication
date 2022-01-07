@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])

{{--@section('header-title', 'お問い合わせ')--}}

@section('content')
    
@if(session()->get('success'))
<div class="alert alert-success">
   {{ session()->get('success') }} 
</div>
@endif

<h1>{{ __('送信完了') }}</h1>

@endsection('content')