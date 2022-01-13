@extends('layouts.admin.admin',["title"=>"U_Dectionary"])

@section('content')

<div class="container">

{{ Breadcrumbs::render('admin.event.post',$event) }}

</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card base-card">
                <div class="card-header">イベント情報</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">お題・テーマ: <strong>{{ $event->event_text }}</strong>｣な状況(時)の表現</li>
                        <li class="list-group-item">イベントタイプ: {{ $event->eventLabel() }}</li>
                        <li class="list-group-item"><i class="bi bi-person-fill"></i> イベント発案者: {{ ($event->user) ? $event->user->name : "-"}}</li>
                        <li class="list-group-item"><time datetime="{{ $event->updated_at->format('Y-m-d H:i:s') }}">作成日時: {{ $event->updated_at->format("Y-m-d H:i:s") }}</time></li>
                        <li class="list-group-item">イベント終了日時: {{ $event->schedule_end }}</li>
                        <li class="list-group-item"><span class="badge badge-primary">エントリー数: {{ $event->posts->count() }}件</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="heading">
    <h2><strong><span class="under">イベントエントリー</span></strong></h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card base-card">
                <div class="card-header">{{ __('イベントエントリー') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.event.postDone', $event->id) }}">
                    @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input
                                name="event_id"
                                type="hidden"
                                value="{{ $event->id }}"/>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="post_text" class="col-md-4 col-form-label text-md-right">{{ __('エントリー') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="4" name="post_text">{{ old('post_text') }}</textarea>
                                <p>はどう？</p>
                            </div>
                            <!-- <div class="col-md-6">
                                <input type="checkbox" name="auto_phrase" value="1" checked/>
                                表現にも自動で投稿する
                            </div> -->
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