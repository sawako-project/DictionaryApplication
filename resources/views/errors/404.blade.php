@extends('errors.layouts.base')

@section('title', '404 Not Found')

@section('message', ' すみません!お探しのページが見つかりませんでした……。')
{{-- 該当アドレスのページを見つける事ができませんでした。 The page of the corresponding address could not be found.--}}

@section('detail', 'サーバーは要求されたリソースを見つけることができなかったことを示します。 URLのタイプミス、もしくはページが移動または削除された可能性があります。 トップページに戻るか、もう一度検索してください。')
{{-- The server indicates that it could not find the requested resource. A typo in the URL, or the page may have been moved or deleted. Please go back to the top page or search again. --}}

@section('link')
    <a href="{{ url('/') }}">{{ __('トップに戻る') }}</a>
@endsection