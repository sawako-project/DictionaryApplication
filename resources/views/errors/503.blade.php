@extends('layouts.errors')

@section('title', '503 Service Unavailable')
{{-- サービス利用不可 --}}

@section('message', 'このページへは事情によりアクセスできません。')
{{-- You can not access this page due to circumstances. --}}

@section('detail', 'サービスが一時的に過負荷やメンテナンスで使用不可能な状態です。')
{{-- Service is temporarily unusable due to overload or maintenance. --}}

@section('link')
    <a href="{{ url('/') }}">{{ __('トップに戻る') }}</a>
@endsection