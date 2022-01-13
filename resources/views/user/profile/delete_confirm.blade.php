@extends('layouts.dictionary',["title"=>"Dectionary","show_mv" => false])
 
{{--@section('header-title', '退会する')--}}

@section('content')

{{ Breadcrumbs::render('user_info.delete_confirm') }}

<div class="container"><!-- container-fluid -->
    <div class="row"><!-- row no-gutters -->
        <div class="col-sm-12">
            <p class="card-text" style="font-family: 'Kiwi Maru', serif;">退会すると作成した表現、作成したイベントも全て削除されます。</p>
            <p class="card-text" style="font-family: 'Kiwi Maru', serif;">それでも退会しますか？</p>
            <div class="form-group row mb-1">
                <div class="col-md-6 offset-md-4">
                    <a href="{{ route('user_info.index') }}" class="btn btn-primary">キャンセルする</a>
                    <!-- <button type="submit" name="action" class="btn btn-primary" value="back">
                        {{-- __('キャンセルする') --}}
                    </button> -->
                </div>
            </div>
            <form method="post" action="{{ url('/user/info/delete/'.$user->id) }}">
            @csrf
                <div class="form-group row mb-1">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="action" class="btn btn-danger" value="submit">
                            {{ __('退会する') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection('content')