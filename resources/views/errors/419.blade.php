@extends('errors.layouts.base')<!-- 'layouts.errors' -->

@section('title', '419 Not Found')

@section('message', ' すみません！お探しのページが見つかりませんでした……。')
{{-- 該当アドレスのページを見つける事ができませんでした。 The page of the corresponding address could not be found.--}}
{{-- --}}

{{-- @section('detail', 'The server indicates that it could not find the requested resource. A typo in the URL, or the page may have been moved or deleted. Please go back to the top page or search again.') --}}
{{-- サーバーは要求されたリソースを見つけることができなかったことを示します。 URLのタイプミス、もしくはページが移動または削除された可能性があります。 トップページに戻るか、もう一度検索してください。 --}}

@section('link')
  <!-- <p><a href="{{--env('APP_URL')--}}">to TOP&gt;&gt;</a></p> -->
  <a href="{{ url('/') }}">{{ __('トップに戻る') }}</a>
  <!-- <button class="btn btn-primary"><a href="{{-- url('/') --}}" class="text-white">{{-- __('トップに戻る') --}}</a></button> -->
@endsection