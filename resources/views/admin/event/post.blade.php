@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

{{--@section('header-title', 'イベントエントリー')--}}

@section('content')

<div class="user-event-post container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                    @include("parts.event.event_info", ["event" => $event])
                </div>
            </div>
        </div>

                <!-- <div class="heading">
            <h2><strong><span class="under">イベントエントリー</span></strong></h2>
        </div> -->

        <div class="col-md-8 mb-5">
            <div class="card base-card">
                <div class="card-header">{{ __('イベントにエントリー') }}</div>
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
                    <form method="post" action="{{ route('user.event.postDone', $event->id) }}">
                    @csrf
                        <input
                        name="event_id"
                        type="hidden"
                        value="{{ $event->id }}"
                        />
                        
                        <div class="form-group row">
                            <label for="post_text" class="col-md-4 col-form-label text-md-right">{{ __('エントリー') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="4" name="post_text">{{ old('post_text') }}</textarea>
                                <span>はどう？</span>
                            </div>

                        <!--  -->
                            <!-- <div class="col-md-6">
                                <input type="checkbox" name="auto_phrase" value="1" checked/>
                                表現にも自動で投稿する
                            </div> -->
                        <!--  -->

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')